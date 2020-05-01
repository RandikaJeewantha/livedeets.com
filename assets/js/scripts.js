$(document).ready(function () {

  $('.menu-toggle').on('click', function () {
    $('.nav').toggleClass('showing');
    $('.nav ul').toggleClass('showing');
  });

  $('.post-wrapper').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    nextArrow: $('.next'),
    prevArrow: $('.prev'),
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 4,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });

});

ClassicEditor
  .create(document.querySelector('#body'), {
    toolbar: ['undo', 'redo', 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'imageUpload'],
    heading: {
      options: [
        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
      ]
    },
    image: {
      toolbar: [
        'imageStyle:full',
        'imageStyle:side',
        '|',
        'imageTextAlternative'
      ]
    }
  })
  .catch(error => {
    console.log(error);
  });

// online counter

$(document).ready(function() {
  setInterval(function(){
    $.ajax ({
      type:'post',
      url:'',
      data: {
        get_online_visitor:"online_visior",
      },
      success:function(response) {
        if(response!="") {
          $("#online_visitor_val").html(response);
        }
      }
    });
  }, 10000)
});

// social shares

function shareFunction(name, link) {

  if (name == "facebook") {
    window.open("https://facebook.com/sharer.php?u="+link, 
    "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=50,width=400,height=400");
  }

  if (name == "twitter") {
    window.open("https://twitter.com/intent/tweet?text="+link, 
    "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=50,width=400,height=400");
  }

  if (name == "google") {
    window.open("https://plus.google.com/share?url="+link, 
    "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=50,width=400,height=400");
  }

  if (name == "linkedin") {
    window.open("https://www.linkedin.com/shareArticle?mini=true&url="+link, 
    "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=50,width=400,height=400");
  }

  if (name == "instagram") {
    window.open("https://www.instagram.com/", 
    "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=50,width=400,height=400");
  }

  window.location.href=""+link+"?&s=1";
  
}

// Likes Dislikes

function likeDislikefunc(name, link) {

  if (name == "like") {
    window.location.href=""+link+"&l=y";
  }

  if (name == "dislike") {
    window.location.href=""+link+"&l=n";
  }
  
}
