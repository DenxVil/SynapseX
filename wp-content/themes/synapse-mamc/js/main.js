jQuery(document).ready(function($) {
    'use strict';
    
    // Event Registration Form Submission
    $('#event-registration-form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = {
            action: 'event_registration',
            nonce: synapseAjax.nonce,
            event_id: $(this).find('input[name="event_id"]').val(),
            participant_name: $(this).find('input[name="participant_name"]').val(),
            participant_email: $(this).find('input[name="participant_email"]').val(),
            participant_phone: $(this).find('input[name="participant_phone"]').val(),
            participant_college: $(this).find('input[name="participant_college"]').val()
        };
        
        var $submitBtn = $(this).find('button[type="submit"]');
        var originalText = $submitBtn.text();
        $submitBtn.text('Submitting...').prop('disabled', true);
        
        $.ajax({
            url: synapseAjax.ajaxurl,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#form-message').html('<div style="padding: 15px; background: #d4edda; color: #155724; border-radius: 5px; border: 1px solid #c3e6cb;">' + response.data.message + '</div>');
                    $('#event-registration-form')[0].reset();
                    
                    // Scroll to message
                    $('html, body').animate({
                        scrollTop: $('#form-message').offset().top - 100
                    }, 500);
                } else {
                    $('#form-message').html('<div style="padding: 15px; background: #f8d7da; color: #721c24; border-radius: 5px; border: 1px solid #f5c6cb;">' + response.data.message + '</div>');
                }
                
                $submitBtn.text(originalText).prop('disabled', false);
            },
            error: function() {
                $('#form-message').html('<div style="padding: 15px; background: #f8d7da; color: #721c24; border-radius: 5px; border: 1px solid #f5c6cb;">An error occurred. Please try again.</div>');
                $submitBtn.text(originalText).prop('disabled', false);
            }
        });
    });
    
    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(e) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 800);
        }
    });
    
    // Fade in animations on scroll
    function fadeInOnScroll() {
        $('.fade-in').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();
            
            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('visible');
            }
        });
    }
    
    // Trigger fade in on load and scroll
    fadeInOnScroll();
    $(window).on('scroll', fadeInOnScroll);
    
    // Mobile menu toggle (if needed in future)
    $('.menu-toggle').on('click', function() {
        $('.main-navigation').toggleClass('active');
    });
});
