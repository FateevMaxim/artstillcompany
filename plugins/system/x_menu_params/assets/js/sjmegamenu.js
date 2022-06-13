jQuery(document).ready(function($){
	;(function(element){
		var $element = $(element);
		
		$('.control-group', $element).first().find('.control-label').remove();
    	$('.control-group', $element).first().find('>.controls').removeClass().addClass('sjmegamenu').unwrap();

    	$.fn.sectionSort = function(){
	        $(this).sortable({
	            items: ".menu-section",
	            placeholder: "menu-section-state-highlight",
	            forcePlaceholderSize: true,
	            opacity: 0.8,
	            handle: ".row-move",
	            distance: 0.5,
	            tolerance: 'pointer',
	            start: function(event, ui) {
	                ui.placeholder.height(ui.item.height());
	            }}).disableSelection();
	    };

	    $.fn.columnSort = function(){
	        $(this).sortable({
	            items: '.column',
	            placeholder: 'ui-state-highlight',
	            opacity: 0.8,
	            dropOnEmpty: true,
	            distance: 0.5,
	            tolerance: 'pointer',
	            start: function(event, ui) {
	                var plus;
	                if(ui.item.hasClass('sj-col-sm-1')) plus = 'sj-col-sm-1'; else
	                if(ui.item.hasClass('sj-col-sm-2')) plus = 'sj-col-sm-2'; else
	                if(ui.item.hasClass('sj-col-sm-3')) plus = 'sj-col-sm-3'; else
	                if(ui.item.hasClass('sj-col-sm-4')) plus = 'sj-col-sm-4'; else
	                if(ui.item.hasClass('sj-col-sm-5')) plus = 'sj-col-sm-5'; else
	                if(ui.item.hasClass('sj-col-sm-7')) plus = 'sj-col-sm-7'; else
	                if(ui.item.hasClass('sj-col-sm-8')) plus = 'sj-col-sm-8'; else
	                if(ui.item.hasClass('sj-col-sm-9')) plus = 'sj-col-sm-9'; else
	                if(ui.item.hasClass('sj-col-sm-10')) plus = 'sj-col-sm-10'; else
	                if(ui.item.hasClass('sj-col-sm-11')) plus = 'sj-col-sm-11'; else
	                if(ui.item.hasClass('sj-col-sm-12')) plus = 'sj-col-sm-12'; else
	                    plus = 'sj-col-sm-6';
	                ui.placeholder.addClass(plus);
	                ui.placeholder.height(ui.item.height());
	            }
	        }).disableSelection();
	    };

	    function mdouleSortable(){
	        $('.modules-container').sortable({
	            connectWith: '.modules-container',
	            items: '.draggable-module',
	            placeholder: 'ui-state-highlight',
	            opacity: 0.8,
	            dropOnEmpty: true,
	            distance: 0.5,
	            tolerance: 'pointer'
	        });
	    };

	    $('#sjmegamenulayout', $element).sectionSort();
    	$('.sjmenu', $element).columnSort();

    	mdouleSortable();

    	$('.modules-list', $element).find('.draggable-module').draggable({
	        connectToSortable: '.modules-container',
	        items: '.draggable-module',
	        helper: 'clone',
	        stop: function( event, ui ) {
	            mdouleSortable();
	            ui.helper.removeAttr('style');
	        }
	    });

	    $('#sjmenuWidth', $element).change(function(){
	        var width = $(this).val();
	        if(width >= 200){
	            $('#sjmegamenulayout', $element).css('width', width).data('width', width);
	        }else{
	            alert("Width can't be less than 200 Pixels");
	            $(this).val($('#sjmegamenulayout', $element).data('width'));
	        }
	    });

	    $('.sj-action-bar', $element).on('click', '.alignment', function(event){
	        event.preventDefault();

	        var $that = $(this);
	        $('.alignment', $element).removeClass('active');
	        $that.addClass('active');
	        $('#sjmegamenulayout', $element).data('menu_align',$(this).data('al_flag'));
	    });

	    $('.sj-add-layout', $element).on('click', function(event){
	        event.preventDefault();
	        $('body').removeClass('sj-modal-open').addClass('sj-modal-open');
	        $('body').append('<div class="sj-modal-overload"></div>');
	        $('#sj-layout-modal', $element).show();
	    });

	    $('.modules-container .fa-remove', $element).on('click', function(event) {
	        event.preventDefault();
	        $(this).closest('.draggable-module').fadeOut(400).delay(400, function(){
	            $(this).remove();
	        });
	    });

	    $('.sj-layout-reset', $element).on('click', function(event) {
	        event.preventDefault();
	        var $that = $(this);
	        var data = {
	            action   : 'resetLayout',
	            layoutName : $that.data('current_item')
	        };

	        var request = {
	            'option' : 'com_ajax',
	            'plugin' : 'xmenu',
	            'data'   : data,
	            'format' : 'raw'
	        };
	        
	        $.ajax({
	            type   : 'POST',
	            data   : request,
	            dataType: "html",
	            success: function (response) {
	                if (response) {
	                    $('#sjmegamenulayout', $element).find('.menu-section').remove();
	                    $('#sjmegamenulayout', $element).append(response);

	                    // sorting layout
	                    $('#sjmegamenulayout', $element).sectionSort();
	                    $('.sjmenu', $element).columnSort();
	                    mdouleSortable();
	                }
	            }
	        });
	    });

	    $('#sj-layout-modal a', $element).on('click', function(event){
	    	event.preventDefault();

	        if($(this).hasClass('active')){
	            return;
	        }

	        var $that           = $(this),
	            newLayoutData   = $that.data('layout'),
	            layoutDesign    = $that.data('design'),
	            $parent         = $(this).closest('#sj-layout-modal'),
	            oldLayout       = $('#sjmegamenulayout', $element).data('menu_item'),
	            newLayout       = [12];

	        if(newLayoutData != 12 ){
	            newLayout = newLayoutData.split(',');
	        }

	        if (newLayout.length !== 1 && newLayout.length < oldLayout) {
	            alert("You can't add small layout than default layout");
	            return;
	        }

	        var colHtml = [];

	        var designString = $('#'+layoutDesign, $element).html();

	        $('#sjmegamenulayout', $element).find('.column-items-wrap').each(function(i,val){
	            var $that = $(this);
	            colHtml[i] = this.innerHTML;
	        });

	        if (!String.prototype.format) {
	            String.prototype.format = function() {
	                var args = arguments;
	                return this.replace(/{(\d+)}/g, function(match, number) { 
	                    return typeof args[number] != 'undefined'
	                    ? args[number]
	                    : '<div class="modules-container"></div>'
	                    ;
	                });
	            };
	        }
	        
	        if (newLayout.length === 1) {
	            var html = '';
	            for (var i = 0; i < colHtml.length; i++) {

	                html += colHtml[i];
	            }
	            var newLayoutHtml = designString.format(html);
	        }else{
	            var newLayoutHtml = designString.format(colHtml[0],colHtml[1],colHtml[2],colHtml[3],colHtml[4],colHtml[5]);
	        }	        

	        // Manage Modal layout
	        $parent.find('.active').removeClass('active');
	        // $parent.sjmodal('hide');
	        $('#sj-layout-modal', $element).hide();
	        $('body').removeClass('sj-modal-open');
	        $('.sj-modal-overload').remove();
	        $(this).addClass('active');

	        var $oldLayoutHtml = $('#sjmegamenulayout', $element).find('.menu-section');
	        
	        $oldLayoutHtml.remove();
	        $('#sjmegamenulayout', $element).append(newLayoutHtml);

	        if (newLayout.length === 1) {
	            $('#sjmegamenulayout', $element).find('.modules-container').remove();
	            $('#sjmegamenulayout', $element).find('.column-items-wrap').append('<div class="modules-container"></div>');
	        }

	        $('#sjmegamenulayout', $element).sectionSort();
	        $('.sjmenu', $element).columnSort();
	        mdouleSortable();

	    });

		$('.close', $element).click(function() {
			$('#sj-layout-modal', $element).hide();
			$('body').removeClass('sj-modal-open');
	        $('.sj-modal-overload').remove();
		})

		document.adminForm.onsubmit = function(event){
	        var layout = [];

	        // Get each row data;
	        $('#sjmegamenulayout', $element).find('.sjmenu').each(function(index) {
	            var $row = $(this),
	                rowIndex = index;
	                layout[rowIndex] = {
	                    'type'      : 'row',
	                    'attr'      : []
	                };

	                // Get each column data;
	                $row.find('.column').each(function(index) {
	                    var $column = $(this),
	                        colIndex = index,
	                        colGrid = $column.data('column');

	                        layout[rowIndex].attr[colIndex] = {
	                            'type'          : 'column',
	                            'colGrid'       : colGrid,
	                            'menuParentId'  : '',
	                            'moduleId'      : ''
	                        };

	                    // get current child id
	                    var menuParentId = '';

	                    $column.find('h4').each(function(index, el) {
	                        menuParentId += $(this).data('current_child')+',';
	                    });

	                    if (menuParentId) {
	                        menuParentId = menuParentId.slice(',',-1);
	                        layout[rowIndex].attr[colIndex].menuParentId = menuParentId;
	                    }

	                    // get modules id
	                    var moduleId = '';
	                    $column.find('.draggable-module').each(function(index, el) {
	                        moduleId += $(this).data('mod_id')+',';
	                    });

	                    if(moduleId){
	                        moduleId = moduleId.slice(',',-1);
	                        layout[rowIndex].attr[colIndex].moduleId = moduleId;
	                    }
	                });
	        });
	        
	        var initData = $('#sjmegamenulayout', $element).data();
	        
	        var menumData = {
	            'width'         : initData.width,
	            'menuItem'      : initData.menu_item,
	            'menuAlign'     : initData.menu_align,
	            'layout'        : layout              
	        };

	        var megamenu = 0,
	            mega_lenght = $('#sjmegamenulayout', $element).find('.column').length;

	        if (mega_lenght > 1) {
	            megamenu = 1;
	        }

	        $('#jform_params_sjmegamenu', $element).val(megamenu);
	        $('#jform_params_sjmenulayout', $element).val( JSON.stringify(menumData) );

	        if ($('#megamenulayout').length) {
		        var layout = [];
		        // Get each row data;
		        $('#megamenulayout').find('.spmenu').each(function(index) {
		            var $row = $(this),
		                rowIndex = index;
		                layout[rowIndex] = {
		                    'type'      : 'row',
		                    'attr'      : []
		                };

		                // Get each column data;
		                $row.find('.column').each(function(index) {
		                    var $column = $(this),
		                        colIndex = index,
		                        colGrid = $column.data('column');

		                        layout[rowIndex].attr[colIndex] = {
		                            'type'          : 'column',
		                            'colGrid'       : colGrid,
		                            'menuParentId'  : '',
		                            'moduleId'      : ''
		                        };

		                    // get current child id
		                    var menuParentId = '';

		                    $column.find('h4').each(function(index, el) {
		                        menuParentId += $(this).data('current_child')+',';
		                    });

		                    if (menuParentId) {
		                        menuParentId = menuParentId.slice(',',-1);
		                        layout[rowIndex].attr[colIndex].menuParentId = menuParentId;
		                    }

		                    // get modules id
		                    var moduleId = '';
		                    $column.find('.draggable-module').each(function(index, el) {
		                        moduleId += $(this).data('mod_id')+',';
		                    });

		                    if(moduleId){
		                        moduleId = moduleId.slice(',',-1);
		                        layout[rowIndex].attr[colIndex].moduleId = moduleId;
		                    }
		                });
		        });
		        
		        var initData = $('#megamenulayout').data();
		        
		        var menumData = {
		            'width'         : initData.width,
		            'menuItem'      : initData.menu_item,
		            'menuAlign'     : initData.menu_align,
		            'layout'        : layout              
		        };

		        var megamenu = 0,
		            mega_lenght = $('#megamenulayout').find('.column').length;

		        if (mega_lenght > 1) {
		            megamenu = 1;
		        }

		        $('#jform_params_megamenu').val(megamenu);
		        $('#jform_params_menulayout').val( JSON.stringify(menumData) );
		    }
	    }

	})('#attrib-sjparams');
});