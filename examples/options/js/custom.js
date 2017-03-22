$(document).ready(function() {
	
	// enable fileupload plugin
	$('input[name="files"]').fileuploader({
        limit: 6, // limit of the files {Number}
        maxSize: 5, // files maximal size in Mb {Number}
        fileMaxSize: 2, // file maximal size in Mb {Number}
        extensions: ['jpg', 'jpeg', 'png', 'audio/mp3', 'text/plain'], // allowed extensions or types {Array}
		changeInput: '<div class="fileuploader-input">' +
		                  '<div class="fileuploader-input-caption">' +
                              '<span>${captions.feedback}</span>' +
                          '</div>' +
                          '<div class="fileuploader-input-button">' +
                              '<span>${captions.button}</span>' +
                          '</div>' +
                      '</div>',
		inputNameBrackets: true,
        theme: 'default',
        thumbnails: {
			box: '<div class="fileuploader-items">' +
                      '<ul class="fileuploader-items-list"></ul>' +
                  '</div>',
			boxAppendTo: null,
			item: '<li class="fileuploader-item">' +
                       '<div class="columns">' +
                           '<div class="column-thumbnail">${image}</div>' +
                           '<div class="column-title">' +
                               '<div title="${name}">${name}</div>' +
                               '<span>${size2}</span>' +
                           '</div>' +
                           '<div class="column-actions">' +
                               '<a class="fileuploader-action fileuploader-action-remove" title="Remove"><i></i></a>' +
                           '</div>' +
                       '</div>' +
                       '<div class="progress-bar2">${progressBar}<span></span></div>' +
                   '</li>',
            item2: '<li class="fileuploader-item">' +
                        '<div class="columns">' +
                            '<a href="${data.url}" target="_blank">' +
                                '<div class="column-thumbnail">${image}</div>' +
                                '<div class="column-title">' +
                                    '<div title="${name}">${name}</div>' +
                                    '<span>${size2}</span>' +
                                '</div>' +
                            '</a>' +
                            '<div class="column-actions">' +
                                '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="Download" download><i></i></a>' +
                                '<a class="fileuploader-action fileuploader-action-remove" title="Remove"><i></i></a>' +
                            '</div>' +
                        '</div>' +
                    '</li>',
			itemPrepend: false,
			removeConfirmation: true,
			startImageRenderer: true,
			synchronImages: true,
			canvasImage: {
				width: null,
				height: null
			},
			_selectors: {
				list: '.fileuploader-items-list',
				item: '.fileuploader-item',
				start: '.fileuploader-action-start',
				retry: '.fileuploader-action-retry',
				remove: '.fileuploader-action-remove'
			},
        	beforeShow: function(parentEl, newInputEl, inputEl) {
				// your callback here
			},
			onItemShow: function(item, listEl, parentEl, newInputEl, inputEl) {
				if(item.choosed)
					item.html.find('.column-actions').prepend(
						'<a class="fileuploader-action fileuploader-action-start" title="Start upload"><i></i></a>'
					);
			},
            onItemRemove: function(itemEl, listEl, parentEl, newInputEl, inputEl) {
                itemEl.children().animate({'opacity': 0}, 200, function() {
                    setTimeout(function() {
                        itemEl.slideUp(200, function() {
                            itemEl.remove(); 
                        });
                    }, 100);
                });
            },
			onImageLoaded: function(itemEl, listEl, parentEl, newInputEl, inputEl) {
				// your callback here
			},
		},
        upload: {
            url: 'index.html',
            data: {
		  		isTest: 'yes'
		    },
            type: 'POST',
            enctype: 'multipart/form-data',
            start: false,
            synchron: true,
            beforeSend: function(item, listEl, parentEl, newInputEl, inputEl) {
				item.upload.data.isTest = 'no';
				
				return true;
			},
            onSuccess: function(data, item, listEl, parentEl, newInputEl, inputEl, textStatus, jqXHR) {
                item.html.find('.column-actions').append('<a class="fileuploader-action fileuploader-action-remove fileuploader-action-success" title="Remove"><i></i></a>');
                
                setTimeout(function() {
                    item.html.find('.progress-bar2').fadeOut(400);
                }, 400);
            },
            onError: function(item, listEl, parentEl, newInputEl, inputEl, jqXHR, textStatus, errorThrown) {
				var progressBar = item.html.find('.progress-bar2');
				
				if(progressBar.length > 0) {
					progressBar.find('span').html(0 + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(0 + "%");
					item.html.find('.progress-bar2').fadeOut(400);
				}
                
                item.upload.status != 'cancelled' && item.html.find('.fileuploader-action-retry').length == 0 ? item.html.find('.column-actions').prepend(
                    '<a class="fileuploader-action fileuploader-action-retry" title="Retry"><i></i></a>'
                ) : null;
            },
            onProgress: function(data, item, listEl, parentEl, newInputEl, inputEl) {
                var progressBar = item.html.find('.progress-bar2');
				
                if(progressBar.length > 0) {
                    progressBar.show();
                    progressBar.find('span').html(data.percentage + "%");
                    progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                }
            },
            onComplete: function(listEl, parentEl, newInputEl, inputEl, jqXHR, textStatus) {
				// your callback here
			},
        },
        dragDrop: {
			container: null,
			onDragEnter: function(event, listEl, parentEl, newInputEl, inputEl) {
				// your callback here
			},
			onDragLeave: function(event, listEl, parentEl, newInputEl, inputEl) {
				// your callback here
			},
			onDrop: function(event, listEl, parentEl, newInputEl, inputEl) {
				// your callback here
			},
			
	    },
        addMore: false,
        files: [{
			name: 'filename1.txt',
			size: 1024,
			type: 'text/plain',
			file: 'uploads/filename1.txt',
			data: {
				url: 'http://google.com/'							  
		    }
	  	}],
        clipboardPaste: 2000,
        listInput: true,
        enableApi: true,
		listeners: {
			click: function(event) {
				// input was clicked
			}	
		},
		onSupportError: function(parentEl, inputEl) {
			// your callback here
		},
        beforeRender: function(parentEl, inputEl) {
			// your callback here
			
			return true;
		},
        afterRender: function(listEl, parentEl, newInputEl, inputEl) {
			// your callback here
		},
        beforeSelect: function(files, listEl, parentEl, newInputEl, inputEl) {
			// your callback here
			return true;
		},
        onFilesCheck: function(files, options, listEl, parentEl, newInputEl, inputEl) {
			// your callback here
			return true;
		},
        onSelect: function(item, listEl, parentEl, newInputEl, inputEl) {
			// your callback here
		},
		afterSelect: function(listEl, parentEl, newInputEl, inputEl) {
			// your callback here
		},
        onListInput: function(fileList, listInputEl, listEl, parentEl, newInputEl, inputEl) {
			var list = [];
			
			$.each(fileList, function(index, value) {
				list.push(value.name);
			});
			
			return list;
		},
        onRemove: function(item, listEl, parentEl, newInputEl, inputEl) {
			// your callback
			return true;
		},
        onEmpty: function(listEl, parentEl, newInputEl, inputEl) {
			// your callback
		},
        dialogs: {
            alert: function(text) {
                return alert(text);
            },
            confirm: function(text, callback) {
                confirm(text) ? callback() : null;
            }
        },
        captions: {
            button: function(options) { return 'Choose ' + (options.limit == 1 ? 'File' : 'Files'); },
            feedback: function(options) { return 'Choose ' + (options.limit == 1 ? 'file' : 'files') + ' to upload'; },
            feedback2: function(options) { return options.length + ' ' + (options.length > 1 ? ' files were' : ' file was') + ' chosen'; },
            drop: 'Drop the files here to Upload',
            paste: '<div class="fileuploader-pending-loader"><div class="left-half" style="animation-duration: ${ms}s"></div><div class="spinner" style="animation-duration: ${ms}s"></div><div class="right-half" style="animation-duration: ${ms}s"></div></div> Pasting a file, click here to cancel.',
            removeConfirmation: 'Are you sure you want to remove this file?',
            errors: {
                filesLimit: 'Only ${limit} files are allowed to be uploaded.',
                filesType: 'Only ${extensions} files are allowed to be uploaded.',
                fileSize: '${name} is too large! Please choose a file up to ${fileMaxSize}MB.',
                filesSizeAll: 'Files that you choosed are too large! Please upload files up to ${maxSize} MB.',
                fileName: 'File with the name ${name} is already selected.',
                folderUpload: 'You are not allowed to upload folders.'
            }
        }
	});
	
});