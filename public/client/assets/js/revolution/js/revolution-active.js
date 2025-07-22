
var revapi4,
    tpj;    
(function() {            
    if (!/loaded|interactive|complete/.test(document.readyState)) document.addEventListener("DOMContentLoaded",onLoad)
        else
    onLoad();
    function onLoad() {                
        if (tpj===undefined) {
            tpj = jQuery;
            if("off" == "on") tpj.noConflict();        
        }

        // Slider No
        if(tpj("#rev_slider_3_1").revolution == undefined){
            revslider_showDoubleJqueryError("#rev_slider_3_1");
        }else{
        revapi3 = tpj("#rev_slider_3_1").show().revolution({
            sliderType:"standard",
            sliderLayout:"fullwidth",
            dottedOverlay:"none",
            delay:9000,
            navigation: {
                keyboardNavigation:"off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                 mouseScrollReverse:"default",
                onHoverStop:"off",
                arrows: {
                    style:"hephaistos",
                    enable:true,
                    hide_onmobile:false,
                    hide_onleave:false,
                    tmp:'',
                    left: {
                        container:"layergrid",
                        h_align:"left",
                        v_align:"bottom",
                        h_offset:320,
                        v_offset:100
                    },
                    right: {
                        container:"layergrid",
                        h_align:"left",
                        v_align:"bottom",
                        h_offset:370,
                        v_offset:100
                    }
                }
            },
            responsiveLevels:[1240,1024,778,480],
            visibilityLevels:[1240,1024,778,480],
            gridwidth:[1920,1024,778,480],
            gridheight:[930,496,377,620],
            lazyType:"none",
            shadow:0,
            spinner:"spinner0",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
                simplifyAll:"off",
                nextSlideOnWindowFocus:"off",
                disableFocusListener:false,
            }
        });
    }; /* END OF revapi call */
        
        
        
    
/*-------- Home 2 active ---------*/
        
        
if(tpj("#rev_slider_4_1").revolution == undefined){
revslider_showDoubleJqueryError("#rev_slider_4_1");
    }else{
        revapi4 = tpj("#rev_slider_4_1").show().revolution({
            sliderType:"standard",
            sliderLayout:"auto",
            dottedOverlay:"none",
            delay:9000,
            navigation: {
                keyboardNavigation:"off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                 mouseScrollReverse:"default",
                onHoverStop:"off",
                bullets: {
                    enable:true,
                    hide_onmobile:false,
                    style:"custom-bullet-01",
                    hide_onleave:false,
                    direction:"vertical",
                    h_align:"right",
                    v_align:"bottom",
                    h_offset:40,
                    v_offset:80,
                    space:5,
                    tmp:'<span class="tp-bullet-title">{{title}}</span>'
                }
            },
            responsiveLevels:[1990,1240,1024,778,480],
            visibilityLevels:[1990,1720,1240,1024,778,480],
            gridwidth:[2300,1774,1024,778,480],
            gridheight:[1000,800,450,330,720],
            lazyType:"none",
            shadow:0,
            spinner:"spinner0",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
                simplifyAll:"off",
                nextSlideOnWindowFocus:"off",
                disableFocusListener:false,
            }
        });
}; /* END OF revapi call */

    
    if(tpj("#rev_slider_5_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_5_1");
				}else{
        revapi5 = tpj("#rev_slider_5_1").show().revolution({
            sliderType:"standard",
            sliderLayout:"auto",
            dottedOverlay:"none",
            delay:9000,
            navigation: {
                onHoverStop:"off",
            },
            responsiveLevels:[1240,1024,778,480],
            visibilityLevels:[1240,1024,778,480],
            gridwidth:[1920,1024,778,480],
            gridheight:[930,496,377,620],
            lazyType:"none",
            shadow:0,
            spinner:"spinner0",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
                simplifyAll:"off",
                nextSlideOnWindowFocus:"off",
                disableFocusListener:false,
            }
        });
    }; /* END OF revapi call */    
        
    
    /*-------- Home 4 active ---------*/    
        
    if(tpj("#rev_slider_6_1").revolution == undefined){
            revslider_showDoubleJqueryError("#rev_slider_6_1");
        }else{
        revapi6 = tpj("#rev_slider_6_1").show().revolution({
            sliderType:"standard",
            sliderLayout:"auto",
            dottedOverlay:"none",
            delay:9000,
            navigation: {
                keyboardNavigation:"off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                 mouseScrollReverse:"default",
                onHoverStop:"off",
                bullets: {
                    enable:true,
                    hide_onmobile:false,
                    style:"custom-bullet-01",
                    hide_onleave:false,
                    direction:"vertical",
                    h_align:"right",
                    v_align:"center",
                    h_offset:20,
                    v_offset:0,
                    space:15,
                    tmp:'<span class="tp-bullet-title">{{title}}</span>'
                }
            },
            responsiveLevels:[1240,1024,778,480],
            visibilityLevels:[1240,1024,778,480],
            gridwidth:[1920,1024,778,480],
            gridheight:[880,469,357,620],
            lazyType:"none",
            shadow:0,
            spinner:"spinner0",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
                simplifyAll:"off",
                nextSlideOnWindowFocus:"off",
                disableFocusListener:false,
            }
        });
    }; /* END OF revapi call */    
        
        
        
    /*-------- Home 5 active ---------*/      
        
    if(tpj("#rev_slider_7_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_7_1");
    }else{
    revapi7 = tpj("#rev_slider_7_1").show().revolution({
        sliderType:"standard",
        sliderLayout:"auto",
        dottedOverlay:"none",
        delay:9000,
        navigation: {
            keyboardNavigation:"off",
            keyboard_direction: "horizontal",
            mouseScrollNavigation:"off",
             mouseScrollReverse:"default",
            onHoverStop:"off",
            bullets: {
                enable:true,
                hide_onmobile:false,
                style:"custom-bullet-01",
                hide_onleave:false,
                direction:"vertical",
                h_align:"right",
                v_align:"center",
                h_offset:20,
                v_offset:0,
                space:15,
                tmp:'<span class="tp-bullet-title">{{title}}</span>'
            }
        },
        responsiveLevels:[1240,1024,778,480],
        visibilityLevels:[1240,1024,778,480],
        gridwidth:[1920,1024,778,480],
        gridheight:[780,469,357,620],
        lazyType:"none",
        shadow:0,
        spinner:"spinner0",
        stopLoop:"off",
        stopAfterLoops:-1,
        stopAtSlide:-1,
        shuffle:"off",
        autoHeight:"off",
        disableProgressBar:"on",
        hideThumbsOnMobile:"off",
        hideSliderAtLimit:0,
        hideCaptionAtLimit:0,
        hideAllCaptionAtLilmit:0,
        debugMode:false,
        fallbacks: {
            simplifyAll:"off",
            nextSlideOnWindowFocus:"off",
            disableFocusListener:false,
        }
    });
    }; /* END OF revapi call */    
        
    
    /*-------- Home  active ---------*/  
        
    if(tpj("#rev_slider_8_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_8_1");
    }else{
    revapi8 = tpj("#rev_slider_8_1").show().revolution({
        sliderType:"standard",
        sliderLayout:"fullscreen",
        dottedOverlay:"none",
        delay:9000,
        navigation: {
            keyboardNavigation:"off",
            keyboard_direction: "horizontal",
            mouseScrollNavigation:"off",
             mouseScrollReverse:"default",
            onHoverStop:"on",
            touch:{
                touchenabled:"on",
                touchOnDesktop:"off",
                swipe_threshold: 75,
                swipe_min_touches: 50,
                swipe_direction: "horizontal",
                drag_block_vertical: false
            }
            ,
            arrows: {
                style:"hades",
                enable:true,
                hide_onmobile:true,
                hide_under:1365,
                hide_onleave:false,
                tmp:'<div class="tp-arr-allwrapper">	<div class="tp-arr-imgholder"></div></div>',
                left: {
                    h_align:"left",
                    v_align:"bottom",
                    h_offset:240,
                    v_offset:40
                },
                right: {
                    h_align:"left",
                    v_align:"bottom",
                    h_offset:400,
                    v_offset:40
                }
            }
            ,
            bullets: {
                enable:true,
                hide_onmobile:false,
                hide_over:1365,
                style:"ares",
                hide_onleave:false,
                direction:"vertical",
                h_align:"right",
                v_align:"bottom",
                h_offset:20,
                v_offset:20,
                space:5,
                tmp:'<span class="tp-bullet-title">{{title}}</span>'
            }
        },
        responsiveLevels:[1240,1024,778,480],
        visibilityLevels:[1240,1024,778,480],
        gridwidth:[1920,1024,778,480],
        gridheight:[980,768,960,720],
        lazyType:"smart",
        parallax: {
            type:"mouse",
            origo:"slidercenter",
            speed:2000,
          speedbg:0,
          speedls:0,
            levels:[2,3,4,5,6,7,12,16,10,50,47,48,49,50,51,55],
        },
        shadow:0,
        spinner:"off",
        stopLoop:"off",
        stopAfterLoops:-1,
        stopAtSlide:-1,
        shuffle:"off",
        autoHeight:"off",
        fullScreenAutoWidth:"off",
        fullScreenAlignForce:"off",
        fullScreenOffsetContainer: "",
        fullScreenOffset: "",
        hideThumbsOnMobile:"off",
        hideSliderAtLimit:0,
        hideCaptionAtLimit:0,
        hideAllCaptionAtLilmit:0,
        debugMode:false,
        fallbacks: {
            simplifyAll:"off",
            nextSlideOnWindowFocus:"off",
            disableFocusListener:false,
        }
    });
    }; /* END OF revapi call */    
        
        
    /*-------- Home 8 active ---------*/      
        
    if(tpj("#rev_slider_9_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_9_1");
    }else{
        revapi9 = tpj("#rev_slider_9_1").show().revolution({
            sliderType:"standard",
            sliderLayout:"auto",
            dottedOverlay:"none",
            delay:9000,
            navigation: {
                keyboardNavigation:"off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                 mouseScrollReverse:"default",
                onHoverStop:"off",
                bullets: {
                    enable:true,
                    hide_onmobile:false,
                    style:"custom-bullet-01",
                    hide_onleave:false,
                    direction:"vertical",
                    h_align:"right",
                    v_align:"center",
                    h_offset:20,
                    v_offset:0,
                    space:15,
                    tmp:'<span class="tp-bullet-title">{{title}}</span>'
                }
            },
            responsiveLevels:[1240,1024,778,480],
            visibilityLevels:[1240,1024,778,480],
            gridwidth:[1920,1024,778,480],
            gridheight:[950,507,385,620],
            lazyType:"none",
            shadow:0,
            spinner:"spinner0",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
                simplifyAll:"off",
                nextSlideOnWindowFocus:"off",
                disableFocusListener:false,
            }
        });
    }; /* END OF revapi call */    
        
    
    /*-------- Home 10 active ---------*/  
        
    if(tpj("#rev_slider_10_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_10_1");
    }else{
        revapi10 = tpj("#rev_slider_10_1").show().revolution({
            sliderType:"standard",
            sliderLayout:"auto",
            dottedOverlay:"none",
            delay:9000,
            navigation: {
                onHoverStop:"off",
            },
            responsiveLevels:[1240,1024,778,480],
            visibilityLevels:[1240,1024,778,480],
            gridwidth:[1530,1024,778,480],
            gridheight:[839,562,427,620],
            lazyType:"none",
            shadow:0,
            spinner:"spinner0",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
                simplifyAll:"off",
                nextSlideOnWindowFocus:"off",
                disableFocusListener:false,
            }
        });
    }; /* END OF revapi call */
        
        
    /*--------------- Home 11 active ------------------*/    
    if(tpj("#rev_slider_11_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_11_1");
    }else{
        revapi11 = tpj("#rev_slider_11_1").show().revolution({
            sliderType:"standard",
            sliderLayout:"fullscreen",
            dottedOverlay:"none",
            delay:9000,
            navigation: {
                keyboardNavigation:"off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                 mouseScrollReverse:"default",
                onHoverStop:"off",
                arrows: {
                    style:"gyges",
                    enable:true,
                    hide_onmobile:true,
                    hide_under:1365,
                    hide_onleave:false,
                    tmp:'',
                    left: {
                        h_align:"right",
                        v_align:"top",
                        h_offset:160,
                        v_offset:60
                    },
                    right: {
                        h_align:"right",
                        v_align:"bottom",
                        h_offset:160,
                        v_offset:100
                    }
                }
                ,
                bullets: {
                    enable:true,
                    hide_onmobile:false,
                    hide_over:1365,
                    style:"ares",
                    hide_onleave:false,
                    direction:"horizontal",
                    h_align:"center",
                    v_align:"bottom",
                    h_offset:0,
                    v_offset:60,
                    space:5,
                    tmp:'<span class="tp-bullet-title">{{title}}</span>'
                }
                ,
                thumbnails: {
                    style:"hesperiden",
                    enable:true,
                    width:200,
                    height:200,
                    min_width:100,
                    wrapper_padding:5,
                    wrapper_color:"transparent",
                    tmp:'<span class="tp-thumb-image"></span><span class="tp-thumb-title">{{title}}</span>',
                    visibleAmount:4,
                    hide_onmobile:true,
                    hide_under:1365,
                    hide_onleave:false,
                    direction:"vertical",
                    span:false,
                    position:"inner",
                    space:5,
                    h_align:"right",
                    v_align:"center",
                    h_offset:80,
                    v_offset:0
                }
            },
            responsiveLevels:[1240,1024,778,480],
            visibilityLevels:[1240,1024,778,480],
            gridwidth:[1920,1204,778,480],
            gridheight:[868,768,600,820],
            lazyType:"none",
            shadow:0,
            spinner:"spinner0",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"off",
            fullScreenAutoWidth:"off",
            fullScreenAlignForce:"off",
            fullScreenOffsetContainer: "",
            fullScreenOffset: "",
            disableProgressBar:"on",
            hideThumbsOnMobile:"on",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
                simplifyAll:"off",
                nextSlideOnWindowFocus:"off",
                disableFocusListener:false,
            }
        });
    }; /* END OF revapi call */    
        
        
        
    /*-------- Home 12 active ---------*/      
        
    if(tpj("#rev_slider_12_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_12_1");
    }else{
        revapi12 = tpj("#rev_slider_12_1").show().revolution({
            sliderType:"standard",
            sliderLayout:"auto",
            dottedOverlay:"none",
            delay:9000,
            navigation: {
                keyboardNavigation:"off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                 mouseScrollReverse:"default",
                onHoverStop:"off",
                arrows: {
                    style:"gyges",
                    enable:true,
                    hide_onmobile:false,
                    hide_onleave:false,
                    tmp:'',
                    left: {
                        h_align:"right",
                        v_align:"bottom",
                        h_offset:75,
                        v_offset:30
                    },
                    right: {
                        h_align:"right",
                        v_align:"bottom",
                        h_offset:30,
                        v_offset:30
                    }
                }
            },
            responsiveLevels:[1240,1024,778,480],
            visibilityLevels:[1240,1024,778,480],
            gridwidth:[1170,1024,778,480],
            gridheight:[560,490,372,620],
            lazyType:"none",
            shadow:0,
            spinner:"spinner0",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
                simplifyAll:"off",
                nextSlideOnWindowFocus:"off",
                disableFocusListener:false,
            }
        });
    }; /* END OF revapi call */    
        
    
    /*-------- Home 13 active ---------*/  
        
    if(tpj("#rev_slider_13_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_13_1");
    }else{
        revapi13 = tpj("#rev_slider_13_1").show().revolution({
            sliderType:"standard",
            sliderLayout:"auto",
            dottedOverlay:"none",
            delay:9000,
            navigation: {
                keyboardNavigation:"off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                 mouseScrollReverse:"default",
                onHoverStop:"off",
                bullets: {
                    enable:true,
                    hide_onmobile:false,
                    style:"ares",
                    hide_onleave:false,
                    direction:"horizontal",
                    h_align:"center",
                    v_align:"bottom",
                    h_offset:0,
                    v_offset:30,
                    space:15,
                    tmp:'<span class="tp-bullet-title">{{title}}</span>'
                }
            },
            responsiveLevels:[1240,1024,778,480],
            visibilityLevels:[1240,1024,778,480],
            gridwidth:[1920,1024,778,480],
            gridheight:[699,469,357,520],
            lazyType:"none",
            shadow:0,
            spinner:"spinner0",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
                simplifyAll:"off",
                nextSlideOnWindowFocus:"off",
                disableFocusListener:false,
            }
        });
    }; /* END OF revapi call */    
        
        
    /*-------- Home 15 active ---------*/      
        
    if(tpj("#rev_slider_14_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_14_1");
    }else{
        revapi14 = tpj("#rev_slider_14_1").show().revolution({
            sliderType:"standard",
            sliderLayout:"auto",
            dottedOverlay:"none",
            delay:9000,
            navigation: {
                keyboardNavigation:"off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                 mouseScrollReverse:"default",
                onHoverStop:"off",
                bullets: {
                    enable:true,
                    hide_onmobile:false,
                    style:"custom-bullet-01",
                    hide_onleave:false,
                    direction:"vertical",
                    h_align:"right",
                    v_align:"center",
                    h_offset:20,
                    v_offset:0,
                    space:15,
                    tmp:'<span class="tp-bullet-title">{{title}}</span>'
                }
            },
            responsiveLevels:[1240,1024,778,480],
            visibilityLevels:[1240,1024,778,480],
            gridwidth:[1920,1024,778,480],
            gridheight:[765,469,357,620],
            lazyType:"none",
            shadow:0,
            spinner:"spinner0",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
                simplifyAll:"off",
                nextSlideOnWindowFocus:"off",
                disableFocusListener:false,
            }
        });
    }; /* END OF revapi call */    
        
    
    /*-------- Home 16 active ---------*/      
        
    if(tpj("#rev_slider_15_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_15_1");
    }else{
        revapi15 = tpj("#rev_slider_15_1").show().revolution({
            sliderType:"standard",
            sliderLayout:"auto",
            dottedOverlay:"none",
            delay:9000,
            navigation: {
                keyboardNavigation:"off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                 mouseScrollReverse:"default",
                onHoverStop:"off",
                bullets: {
                    enable:true,
                    hide_onmobile:false,
                    style:"ares",
                    hide_onleave:false,
                    direction:"horizontal",
                    h_align:"center",
                    v_align:"bottom",
                    h_offset:0,
                    v_offset:30,
                    space:15,
                    tmp:'<span class="tp-bullet-title">{{title}}</span>'
                }
            },
            responsiveLevels:[1240,1024,778,480],
            visibilityLevels:[1240,1024,778,480],
            gridwidth:[1760,1024,778,480],
            gridheight:[837,487,357,620],
            lazyType:"none",
            shadow:0,
            spinner:"spinner0",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
                simplifyAll:"off",
                nextSlideOnWindowFocus:"off",
                disableFocusListener:false,
            }
        });
    }; /* END OF revapi call */    
        
    
        
    /*-------- Home 17 active ---------*/          
        
    if(tpj("#rev_slider_16_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_16_1");
    }else{
        revapi16 = tpj("#rev_slider_16_1").show().revolution({
            sliderType:"standard",
            sliderLayout:"auto",
            dottedOverlay:"none",
            delay:9000,
            navigation: {
                keyboardNavigation:"off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                 mouseScrollReverse:"default",
                onHoverStop:"off",
                bullets: {
                    enable:true,
                    hide_onmobile:false,
                    style:"custom-bullet-01",
                    hide_onleave:false,
                    direction:"vertical",
                    h_align:"left",
                    v_align:"center",
                    h_offset:40,
                    v_offset:0,
                    space:15,
                    tmp:'<span class="tp-bullet-title">{{title}}</span>'
                }
            },
            responsiveLevels:[1240,1024,778,480],
            visibilityLevels:[1240,1024,778,480],
            gridwidth:[1920,1024,778,480],
            gridheight:[860,469,357,620],
            lazyType:"none",
            shadow:0,
            spinner:"spinner0",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
                simplifyAll:"off",
                nextSlideOnWindowFocus:"off",
                disableFocusListener:false,
            }
        });
    }; /* END OF revapi call */    
    
        
    /*-------- Home 18 active ---------*/      
        
    if(tpj("#rev_slider_25_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_25_1");
    }else{
        revapi25 = tpj("#rev_slider_25_1").show().revolution({
            sliderType:"standard",
            sliderLayout:"fullwidth",
            dottedOverlay:"none",
            delay:6000,
            navigation: {
                keyboardNavigation:"off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                 mouseScrollReverse:"default",
                onHoverStop:"off",
                bullets: {
                    enable:true,
                    hide_onmobile:false,
                    style:"ares",
                    hide_onleave:false,
                    direction:"horizontal",
                    h_align:"center",
                    v_align:"bottom",
                    h_offset:0,
                    v_offset:30,
                    space:15,
                    tmp:'<span class="tp-bullet-title">{{title}}</span>'
                }
            },
            lazyType:"none",
            parallax: {
                type:"mouse+scroll",
                origo:"enterpoint",
                speed:400,
              speedbg:0,
              speedls:0,
                levels:[5,10,15,20,25,30,35,40,45,46,47,48,49,50,51,55],
            },
            shadow:0,
            spinner:"spinner0",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"on",
            autoHeight:"on",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
                simplifyAll:"off",
                nextSlideOnWindowFocus:"off",
                disableFocusListener:false,
            }
        });
    }; /* END OF revapi call */    
      
        
        
        
    }; /* END OF ON LOAD FUNCTION */
}()); /* END OF WRAPPING FUNCTION */












