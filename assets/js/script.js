let allowedComment = true;

$('.owl-carousel-slide').owlCarousel({
    items:1,
    loop:true,
    margin:10,
    nav:false,
    autoplay: true,

})

$('.owl-carousel-view').owlCarousel({
    items:1,
    loop:true,
    margin:10,
    nav:true,
    navText: [$('.view-next'),$('.view-prev')],
    autoplay: true,
    dotsContainer: '#carousel-custom-dots .owl-stage'

})

$('.owl-dot').click(function () {
	$('.owl-dot').removeClass('active');
	$(this).addClass('active');
  $('.owl-carousel-view').trigger('to.owl.carousel', [$(this).index(), 300]);
});


$('.nav-mobile-menu').click(function(){
    toggleSidebar();
})




function toggleSidebar() {
    if ($('.sidebar').attr('data-status') == 'off') {
        $('.sidebar').animate({
            'left' : 0,
        },300);
        $('body').css({
            'overflow' :'hidden',
        })
        $('.sidebar').attr('data-status','on')
    } else if($('.sidebar').attr('data-status') == 'on') {
        $('.sidebar').animate({
            'left' : '-100%',
        },300);
        $('body').css({
            'overflow' :'scroll',
        })
        $('.sidebar').attr('data-status','off')

    }


}

$('.type-input').click(function(){
    $('.pet-type').toggle();
})

$('.pet-type li').click(function(){
    $('.pet-type').hide();
    $('.type-input').val($(this).html());
    $('.type-input-form').val($(this).attr('data-animal'))
})


$('#comment-input').focus(function(){
    $(this).keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            let comment = $(this).val();
            if (comment.length > 0) {
                let petId = $(this).attr('data-animal-id');
                if (allowedComment) {    
                    allowedComment = false;
                    $.ajax({
                        url : 'lib/pet-comment.php',
                        method : 'post',
                        data : {'comment' : comment , 'petID' : petId},
                        success:function(data){
                            loadPetComment(petId);
                            $('#comment-input').val('');
                            setTimeout(function(){
                                allowedComment = true;
                            },10000);
                        }
                    })
                }
            }
        }
    });
});

function loadPetComment(petID) {
    $.ajax({
        'url' : 'lib/load-pet-comment.php',
        'method' : 'POST',
        'data' : {'petID' : petID},
        success:function(data){
            let comments = JSON.parse(data);
            let commCounts = comments.length;
            $('.comment-container').html('');
            for(let x = 0; x < commCounts; x++) {
                $('.comment-container').prepend(
                    '<li class="media mb-3 pb-3"> <span class="round"> <img src="'+comments[x]['picture']+'" class="align-self-start mr-3"> </span>'+
                         '<div class="media-body">'+
                             '<div class="row d-flex">'+
                                 '<a href="user/'+comments[x]['userID']+'"><h6 class="user">'+comments[x]['name']+'</h6></a>'+
                                 '<div class="ml-auto">'+
                                     '<p class="text">'+comments[x]['time']+'</p>'+
                                 '</div>'+
                             '</div>'+
                             '<p class="text">'+escapeHtml(comments[x]['comment'])+'</p>'+
                         '</div>'+
                    '</li>')
            }
        }
    })
}

function escapeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
 }




$(document).on('click' , '.love-pet', function(){

    let element = $(this);
    let petID = $(this).attr('data-pet-id');
    $.ajax({
        'url' : 'lib/pet-endpoint/pet-loved.php',
        'method' : 'POST',
        'data' : {'petID' : petID},
        success:function(data){
            if (data == '401') {
               location.reload();
            } else {
               element.find('img').attr('src','assets/images/icon/heart-on.svg');
               element.addClass('unlove-pet')
               element.removeClass('love-pet')
            }
        }
    })

})

$(document).on('click' , '.unlove-pet', function(){
    let element = $(this);
    let petID = $(this).attr('data-pet-id');
    $.ajax({
        'url' : 'lib/pet-endpoint/pet-unloved.php',
        'method' : 'POST',
        'data' : {'petID' : petID},
        success:function(data){
            if (data == '401') {
               location.reload();
            } else {
               element.find('img').attr('src','assets/images/icon/heart-off.svg');
               element.addClass('love-pet')
               element.removeClass('unlove-pet')
            }
        }
    })
})

$('#submit-blog-comment').click(function(){
    let commentID = $(this).val();
    let comment = $('#blog-comment').val();
    if (allowedComment) {    
        allowedComment = false;
        $.ajax({
            'url' : 'lib/blog-endpoint/save-blog-comment.php',
            'method' : 'post',
            'data' : {'commentID' : commentID , 'comment' : comment},
            success:function(data){
                loadBlogComment(commentID);
                setTimeout(function(){
                    allowedComment = true;
                },10000);
            }
        })

    }

});


function loadBlogComment(blogID) {
    $.ajax({
        'url' : 'lib/blog-endpoint/load-blog-comment.php',
        'method' : 'POST',
        'data' : {'blogID' : blogID},
        success:function(data){
            let comments = JSON.parse(data);
            let commCounts = comments.length;
            if (commCounts > 0) {        
                $('.comment-list').html('');
                for(let x = 0; x < commCounts; x++) {

                    $('.comment-list').append(
                        '<div class="comment-box py-2">'+
                            '<div class="comment">'+
                                '<div class="author-thumb"><img src="'+comments[x]['picture']+'" alt=""></div>'+
                                    '<div class="comment-inner">'+
                                        '<div class="comment-info clearfix"><a href="user/'+comments[x]['userID']+'"><strong>'+comments[x]['name']+'</strong></a>'+
                                            '<div class="comment-time">'+comments[x]['time']+'</div>'+
                                        '</div>'+
                                        '<div class="text">'+escapeHtml(comments[x]['comment'])+'</div>'+
                                        '<a class="comment-reply" href="#">Reply</a>'+
                                    '</div>'+
                                '</div>'+
                            '</div>');
            
                }
            }
            $('#blog-comment').val('')
        }
    })
}


function reisizeImage(){
    $('.liked-gallery img').each(function(){
        $(this).height($(this).width());
    })

    $('.pet-card img').each(function(){
        $(this).height($(this).width() + 50);
    })




}

reisizeImage();
$(window).resize(function(){
  
    reisizeImage();
})



$(document).ready(function(){

    // Get the magic div height
    let posHeight = $('#magic-scroll-fixed').height();

    // Check if magic elem is scrollable 
    let magicElemFullH = $('#magic-scroll-fixed').parent().offset().top * 3;

    let allowFixed = (posHeight + magicElemFullH)  < $(document).height();


    $(window).resize(function(){
        initMagicElem(allowFixed)
    })

    window.addEventListener("scroll",function(){
        initMagicElem(allowFixed)
    });

})



function initMagicElem(allowFixed) {
    // Get the magic div height
    let posHeight = $('#magic-scroll-fixed').height();

    // Check if magic elem is scrollable 
    let magicElemFullH = $('#magic-scroll-fixed').parent().offset().top * 3;

    let magicParent = $('#magic-scroll-fixed').parent().width();
    if (allowFixed && $(window).width() > 767.98) {
         // get the magic div widht for so the width of the magic elem does not overlap
        
         // Detect the magic element when scroll reach to the end
         let magicScrollBottom = $('#magic-scroll-fixed').height() - $(window).height() - $(window).scrollTop() + magicParent;

         let magicScrollBottomParent = $('#magic-scroll-fixed').parent().height() - $(window).height() - $(window).scrollTop() + magicParent;
         $('#magic-scroll-fixed').parent().css({
            'position' : 'relative',
        })
         // Set Paramenter if the magic parent is greater than the window height



         let top = 'auto';
         let bottom = 'auto';
         if (posHeight < $(window).height()) {
             top = '10px';
         } else {
             bottom = '10px';
         }

        if (magicScrollBottom < 0) {

             // Set Fix postion when reach the bottom of the magic elem

             // Check if the magic elem reach the bottom so it does not overlap in the parent container
             if (magicScrollBottomParent < 0) {
                 $('#magic-scroll-fixed').css({
                     'position' : 'absolute',
                     'bottom' : 0,
                     'top' : 'auto',
                     'width' : magicParent,
                     'transition' : 'all 0.8s'

                 })
             } else {
                 $('#magic-scroll-fixed').css({
                     'position' : 'fixed',
                     'bottom' : bottom,
                     'top' : top,
                     'width' : magicParent,
                     'transition' : 'all 0.8s'

                 })
             }

        } else if(magicScrollBottom > 0){
         // set static if not reach the bottom of magic elem
             $('#magic-scroll-fixed').css({
                 'position' : 'static',
                 'bottom' : bottom,
                 'top' : top,
                 'width' : magicParent,
                 'transition' : 'all 0.8s'

             })
        }

    } else {
        $('#magic-scroll-fixed').css({
            'position' : 'relative',
            'top' : '0',
            'width' : magicParent,

        })
    }
}