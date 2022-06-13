/* jce - 2.9.24 | 2022-05-27 | https://www.joomlacontenteditor.net | Copyright (C) 2006 - 2022 Ryan Demmer. All rights reserved | GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html */
!function(){function toAbsolute(u,p){return u.replace(/url\(["']?(.+?)["']?\)/gi,function(a,b){return b.indexOf("://")<0?'url("'+p+b+'")':a})}function isEditorContentCss(url){return url.indexOf("/tiny_mce/")!==-1&&url.indexOf("content.css")!==-1}function cleanSelectorText(selectorText){var selector=/^(?:([a-z0-9\-_]+))?(\.[a-z0-9_\-\.]+)$/i.exec(selectorText);if(!selector)return"";var elementName=selector[1];return"body"!==elementName?selector[2].substr(1).split(".").join(" "):""}function getRGBA(val){if(!rgba[val]){var values,match,r=0,b=0,g=0,a=1;if(val.indexOf("#")!==-1)val=val.substr(1),3===val.length&&(val+=val),r=parseInt(val.substring(0,2),16),g=parseInt(val.substring(2,4),16),b=parseInt(val.substring(4,6),16),val.length>6&&(a=parseInt(val.substring(6,8),16),a=+(a/255).toFixed(2));else{val=val.replace(/\s/g,"");var match=/^(?:rgb|rgba)\(([^\)]*)\)$/.exec(val);match&&(values=match[1].split(",").map(function(x,i){return parseFloat(x)})),values&&(r=values[0],g=values[1],b=values[2],4===values.length&&(a=values[3]||1))}rgba[val]={r:r,g:g,b:b,a:a}}return rgba[val]}function getLuminance(val){if(!luma[val]){var RsRGB,GsRGB,BsRGB,R,G,B,col=getRGBA(val);RsRGB=col.r/255,GsRGB=col.g/255,BsRGB=col.b/255,R=RsRGB<=.03928?RsRGB/12.92:Math.pow((RsRGB+.055)/1.055,2.4),G=GsRGB<=.03928?GsRGB/12.92:Math.pow((GsRGB+.055)/1.055,2.4),B=BsRGB<=.03928?BsRGB/12.92:Math.pow((BsRGB+.055)/1.055,2.4),luma[val]=.2126*R+.7152*G+.0722*B}return luma[val]}function isReadable(color1,color2,wcag2,limit){var l1=getLuminance(color1),l2=getLuminance(color2),lvl=(Math.max(l1,l2)+.05)/(Math.min(l1,l2)+.05);return wcag2=wcag2||4.5,limit=limit||21,lvl>=parseFloat(wcag2)&&lvl<parseFloat(limit)}var each=tinymce.each,DOM=tinymce.DOM,PreviewCss=tinymce.util.PreviewCss,rgba={},luma={};tinymce.create("tinymce.plugins.ImportCSS",{init:function(ed,url){this.editor=ed;var self=this;ed.onImportCSS=new tinymce.util.Dispatcher,ed.onImportCSS.add(function(){tinymce.is(ed.settings.importcss_classes)||self._import()}),ed.onInit.add(function(){ed.onImportCSS.dispatch(),"auto"!==ed.settings.content_style_reset||ed.dom.hasClass(ed.getBody(),"mceContentReset")||self._setHighContrastMode(),self._setGuideLinesColor()}),ed.onFocus.add(function(ed){ed._hasGuidelines||self._setGuideLinesColor()})},_setHighContrastMode:function(){var ed=this.editor,bodybg=ed.dom.getStyle(ed.getBody(),"background-color",!0),color=ed.dom.getStyle(ed.getBody(),"color",!0);if(bodybg&&color){var hex=ed.dom.toHex(bodybg);hex==ed.dom.toHex(color)&&"#000000"===hex||isReadable(color,bodybg,3)||ed.dom.addClass(ed.getBody(),"mceContentReset")}},_setGuideLinesColor:function(){var ed=this.editor,gray=["#000000","#080808","#101010","#181818","#202020","#282828","#303030","#383838","#404040","#484848","#505050","#585858","#606060","#686868","#696969","#707070","#787878","#808080","#888888","#909090","#989898","#a0a0a0","#a8a8a8","#a9a9a9","#b0b0b0","#b8b8b8","#bebebe","#c0c0c0","#c8c8c8","#d0d0d0","#d3d3d3","#d8d8d8","#dcdcdc","#e0e0e0","#e8e8e8","#f0f0f0","#f5f5f5","#f8f8f8","#ffffff"],blue=["#0d47a1","#1565c0","#1976d2","#1e88e5","#2196f3","#42a5f5","#64b5f6","#90caf9","#bbdefb","#e3f2fd"],guidelines="#787878",control="#1e88e5",controlbg="#b4d7ff",placeholder="#efefef",bodybg=ed.dom.getStyle(ed.getBody(),"background-color",!0),color=ed.dom.getStyle(ed.getBody(),"color",!0);if(bodybg){ed._hasGuidelines=!0;for(var i=0;i<gray.length;i++)if(isReadable(gray[i],bodybg,4.5,5)){if(ed.dom.toHex(color)===ed.dom.toHex(gray[i]))continue;guidelines=gray[i];break}for(var i=0;i<blue.length;i++)if(isReadable(blue[i],bodybg,4.5,5)){control=blue[i];break}if(guidelines||control){var css=":root{";guidelines&&(css+="--mce-guidelines: "+guidelines+";"),placeholder&&(css+="--mce-placeholder: "+placeholder+";"),control&&(css+="--mce-control-selection: "+control+";",css+="--mce-control-selection-bg: "+controlbg+";"),css+="}",ed.dom.addStyle(css)}}},_import:function(){function isAllowedStylesheet(href){var styleselect=ed.getParam("styleselect_stylesheets");return!styleselect||("undefined"!=typeof filtered[href]?filtered[href]:(filtered[href]=href.indexOf(styleselect)!==-1,filtered[href]))}function parseCSS(stylesheet){each(stylesheet.imports,function(r){if(r.href.indexOf("://fonts.googleapis.com")>0){var v="@import url("+r.href+");";return void(self.fontface.indexOf(v)===-1&&self.fontface.unshift(v))}parseCSS(r)});try{if(rules=stylesheet.cssRules||stylesheet.rules,href=stylesheet.href,!href)return;if(isEditorContentCss(href))return;href=href.substr(0,href.lastIndexOf("/")+1),ed.hasStyleSheets=!0}catch(e){}each(rules,function(r){switch(r.type||1){case 1:if(!isAllowedStylesheet(stylesheet.href))return!0;r.selectorText&&each(r.selectorText.split(","),function(v){v=v.replace(/^\s*|\s*$|^\s\./g,""),/\.mce/.test(v)||ed.settings.body_class&&new RegExp(".("+ed.settings.body_class.split(" ").join("|")+")").test(v)||!/\.[\w\-]+$/.test(v)||v&&classes.indexOf(v)===-1&&classes.push(v)});break;case 3:if(r.href.indexOf("//fonts.googleapis.com")>0){var v="@import url("+r.href+");";fontface.indexOf(v)===-1&&fontface.unshift(v)}r.href.indexOf("//")===-1&&parseCSS(r.styleSheet);break;case 5:if(r.cssText&&/(fontawesome|glyphicons|icomoon)/i.test(r.cssText)===!1){var v=toAbsolute(r.cssText,href);fontface.indexOf(v)===-1&&fontface.push(v)}}})}var self=this,ed=this.editor,doc=ed.getDoc(),href="",rules=[],fonts=!1,fontface=[],filtered={},classes=[];if(!classes.length)try{each(doc.styleSheets,function(styleSheet){parseCSS(styleSheet)})}catch(ex){}if(!fontface.length&&!fonts)try{var head=DOM.doc.getElementsByTagName("head")[0],style=DOM.create("style",{type:"text/css"}),css=self.fontface.join("\n");if(style.styleSheet){var setCss=function(){try{style.styleSheet.cssText=css}catch(e){}};style.styleSheet.disabled?setTimeout(setCss,10):setCss()}else style.appendChild(DOM.doc.createTextNode(css));head.appendChild(style),fonts=!0}catch(e){}classes.length&&(ed.getParam("styleselect_sort",1)&&classes.sort(),ed.settings.importcss_classes=tinymce.map(classes,function(val){var cls=cleanSelectorText(val),style=PreviewCss(ed,{styles:[],attributes:[],classes:cls.split(" ")});return{selector:val,class:cls,style:style}}))}}),tinymce.PluginManager.add("importcss",tinymce.plugins.ImportCSS)}();