var carrousel = {
    
    nbSlide : 0,
    nbCurrent : 1,
    elementCurrent : null,
    element : null,
    timer : null,
    
    
    init : function(element){
        this.nbSlide = element.find('.slides').length;
        
        //Créer la pagination
        element.append('<div class="navigation"></div>');
        for(var i=1;i<=this.nbSlide;i++){
            element.find('.navigation').append('<span>'+i+'</span>');
        }
        
        element.find('.navigation span').click(function(){ carrousel.gotoSlide($(this).text()); })
        
        
        //Initialisation du carrousel
        this.element = element;
        element.find('.slides').hide();
        element.find('.slides:first').show();
        this.elementCurrent = element.find('.slides:first');
        this.element.find('.navigation span:first').addClass('active');
        
        carrousel.play();        
        //Stop quand on passe dessus
        element.mouseover(carrousel.stop());
        element.mouseout(carrousel.play());
        $("#carrousel").resize(carrousel.redim);
        
        
        
        
    },
    
    gotoSlide : function(num){
        if(num == this.nbCurrent){ return false };
        
        
        
        //Animation en fade
        
        //this.elementCurrent.fadeOut();
        //this.element.find('#slide'+num).fadeIn();
        
        //Animation en slide
        var sens = 1;
        if(num<this.nbCurrent){ sens = -1; };
        var cssDeb = {'left' :sens*this.element.width() };
        var cssFin = {'left' :-sens*this.element.width() };
        this.element.find('#slide'+num).show().css(cssDeb);
        this.element.find('#slide'+num).animate({'top':0,'left':0},500);
        this.elementCurrent.animate(cssFin,500);
        //$("#carrousel").animate({ height:elementCurrent.hauteur },500);
        
        
        
        /* 
        this.elementCurrent.find(".visu").fadeOut();
        this.element.find("#slide"+num).show();
        this.element.find("#slide"+num+" .visu").hide().fadeIn();
        
        var titleHeight=this.elementCurrent.find(".titre").height();
        
        this.elementCurrent.find(".titre").animate({"bottom":-titleHeight},500);
        this.element.find("#slide"+num+" .titre").css("bottom",-titleHeight).animate({"bottom":0},500);
        */
        
        
        this.element.find('.navigation span').removeClass('active');
        this.element.find('.navigation span:eq('+(num-1)+')').addClass('active');
        this.nbCurrent = num;
        this.elementCurrent = this.element.find('#slide'+num);
        
           
    },
    
    next : function(){
        var num = this.nbCurrent+1;
        if(num>this.nbSlide){
            num = 1;
        }
        this.gotoSlide(num);
        
        
    },
    
    prev : function(){
        var num = this.nbCurrent-1;
        if(num<1){
            num = this.nbSlide;
        }
        this.gotoSlide(num);
        
        
    },
    
    stop : function(){
        window.clearInterval(carrousel.timer);
    },
    
    play : function(){
        window.clearInterval(carrousel.timer);
        carrousel.timer = window.setInterval(carrousel.next(),2000);

    }
    
    
 
}

$(function(){
    carrousel.init($('#carrousel'));


});