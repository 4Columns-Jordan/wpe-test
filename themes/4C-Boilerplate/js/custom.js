/* this function needs to run first thing */
// checkHashlink();
/* === Helper Functions === */
/**
 * Handles the header sticky class on scroll
 * headerHeight variable is the distance from top sticky activates
 * stickyClass variable sets the "Sticky" class name
 */
function headerStickyHandler() {
  let scroll = jQuery(window).scrollTop();
  let headerHeight = 1;
  let stickyClass = "sticky";
  if (scroll <= headerHeight) {
    jQuery(".navbar").removeClass(stickyClass);
  }
  if (scroll > headerHeight) {
    jQuery(".navbar").addClass(stickyClass);
  }
}

/**
 * Sets all links that have the target_blank class to target_blank
 */
function setTargets() {
  jQuery(".target_blank").each(function () {
    if (jQuery(this).hasClass("innerColumn")) {
      jQuery(this).find(".col_link").attr("target", "_blank");
    } else if (jQuery(this).prev().prop("nodeName") === "P") {
      jQuery(this).find("a").attr("target", "_blank");
    } else {
      jQuery(this).attr("target", "_blank");
    }
  });
}

/**
 * Sets custom css properties
 * @param {array} array property name, property value
 */
function setCustomProperty(prop) {
  let root = document.documentElement;
  root.style.setProperty(prop[0], prop[1]);
}

/**
 * Calculates the width of the FIRST regular container
 * on the page and sets it's width as a css property.
 */
function calculateContainerWidth() {
  let container = jQuery(".container").eq(0);
  let containerWidth = container.outerWidth() + "px";
  setCustomProperty(["--FC-container-width", containerWidth]);
}

/**
 * Checking if the header has a hash. If so it sets the scroll to 0
 * so the scrollToHash function can smooth scroll.
 */
// function checkHashlink() {
//   if (window.location.hash) scroll(0, 0);
//   setTimeout(scroll(0, 0), 1);
// }

/**
 * Adding Smooth Scroll for hashlinks.
 * Set headerHeight to change ethe header offset
 * set scrollSpeed to change the scroll speed (Milliseconds)
 */
function scrollToHash() {
  let headerHeight = 100;
  let scrollSpeed = 750;
  if (hashTarget) {
	if(history.replaceState) {
    	history.replaceState(null, null, '#' + hashTarget);
	}
	else {
		location.hash = '#' + hashTarget;
	}
    jQuery([document.documentElement, document.body]).animate(
      {
        scrollTop: jQuery('#' + hashTarget).offset().top - headerHeight,
      },
      scrollSpeed
    );
  }
}

/**
 *  Enabling smooth scroll on relative links
 */
jQuery(document).ready(function () {
  jQuery('a[href^="#"]').on("click", function (e) {
    e.preventDefault();
    let target = this.hash;
    history.replaceState("", "", window.location.href + target);
    jQuery([document.documentElement, document.body]).animate(
      { scrollTop: jQuery(target).offset().top - 100 },
      750
    );
  });
});

/**
 * Run at Browser Size
 * This funtion runs the supplied funtion at the browser size specified.
 * Accepts any of bootstrap's container size abbreviations.
 *
 * @param {String} windowSize - Valid args: xxl, xl, lg, md, sm, xs
 * @param {Function} callback - Function to run at window size
 */
function runAtBrowserSize(windowSize, callback) {
  let currentWindowSize = window
    .getComputedStyle(document.body, "::after")
    .getPropertyValue("content");
  /* getPropertyValue returns quotes in the string so were adding them here */
  if (currentWindowSize === '"' + windowSize + '"') {
    callback();
  }
}

/**
 * JQuery is on screen function.
 * This function checks if the targeted element(s) is in the
 * viewport.
 * EX: jQuery('#main').isOnScreen()
 *
 * @returns Bool
 */

jQuery.fn.isOnScreen = function () {
  if (jQuery(this).length < 1) {
    return false;
  }
  var win = jQuery(window);
  var viewport = {
    top: win.scrollTop(),
    left: win.scrollLeft(),
  };
  viewport.right = viewport.left + win.width();
  viewport.bottom = viewport.top + win.height();
  var bounds = this.offset();
  bounds.right = bounds.left + this.outerWidth();
  bounds.bottom = bounds.top + this.outerHeight();
  return !(
    viewport.right < bounds.left ||
    viewport.left > bounds.right ||
    viewport.bottom < bounds.top ||
    viewport.top > bounds.bottom
  );
};
/**
 * This is the function that animates the count up.
 * the animation duration variable sets the duration
 * @param {element} el - The element to count up
 * @returns NULL
 */
const animateCountUp = (el) => {
  if (el.getAttribute("hasRun")) return;
  const animationDuration = 1500;
  const frameDuration = 1000 / 60;
  const totalFrames = Math.round(animationDuration / frameDuration);
  const easeOutQuad = (t) => t * (2 - t);
  let fin = document.createAttribute("hasRun");
  fin.value = true;
  el.setAttributeNode(fin);
  let frame = 0;
  const countTo = parseInt(el.getAttribute("data-rollTo"), 10);
  const counter = setInterval(() => {
    frame++;
    const progress = easeOutQuad(frame / totalFrames);
    const currentCount = Math.round(countTo * progress);
    if (parseInt(el.innerHTML, 10) !== currentCount) {
      el.innerHTML = formatNumber(currentCount);
    }
    if (frame === totalFrames) {
      clearInterval(counter);
    }
  }, frameDuration);
};

/**
 * This function formats the number in a numberRollUp element
 * to have camas every 3 decimal place
 * @param {INT} num
 * @returns String
 */
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
}

/**
 * This function checks all elements with the specified class
 * and begins the count up animation if its on screen.
 *
 * used in main doc ready and main doc scroll below
 */
function numberRollHandler() {
  let elem = ".numberRollUp";
  jQuery(elem).each(function () {
    if (jQuery(this).isOnScreen()) {
      animateCountUp(jQuery(this).get(0));
    }
  });
}

/**
 * This function handles the hamburger menu toggler animations and classes
 */
jQuery(".header__menuToggler").on("click", FC__hamburgerToggler);
function FC__hamburgerToggler() {
  jQuery(".mobileToggle").each(function () {
    let lottie = jQuery(this)[0].getLottie();
    let wrapper = jQuery(".header__navContainer");
    jQuery(".header__menuToggler").toggleClass("active");
    wrapper.toggleClass("active");
    jQuery(".navbar").toggleClass("menuActive");
    if (wrapper.hasClass("active")) {
      jQuery(this).attr("aria-label", "Close Navigation");
      jQuery(this).attr("aria-ecpanded", true);
      lottie.playSegments([0, 39], true);
      jQuery(".menuToggle")[0].getLottie().playSegments([0, 39], true);
    } else {
      jQuery(this).attr("aria-label", "Open Navigation");
      jQuery(this).attr("aria-ecpanded", false);
      lottie.playSegments([39, 78], true);
      jQuery(".menuToggle")[0].getLottie().playSegments([39, 78], true);
    }
  });
}
/**
 * Main Document Ready
 */
jQuery(document).ready(() => {
  calculateContainerWidth();
  setTargets();
  scrollToHash();
  numberRollHandler();
  FC__headingWrapper();
});
/**
 * Main Window Resize
 */
jQuery(window).resize(() => {
  calculateContainerWidth();
});
/**
 * Main Window Scroll
 */
jQuery(window).scroll(() => {
  headerStickyHandler();
  numberRollHandler();
});
/* === Begin Code === */
function FC__headingWrapper() {
  jQuery(".wp-block-heading").each(function () {
    jQuery(this).wrapInner('<span class="heading__underline"></span>');
  });
}

/**
// demo custom cursor follower
const customCursor = document.querySelector(".custom-cursor");

// Listen for mousemove events on the document
document.addEventListener("mousemove", (e) => {
  // Update the cursor's position based on the mouse coordinates
  customCursor.style.left = e.clientX + "px";
  customCursor.style.top = e.clientY + "px";
});
*/

/**
 * Gravity Forms Input Handler
 * This function checks if the inputs have a value and handles
 * adding the classes based off of what type for field they are
 */
jQuery(document).on('click', '.ginput_container input', FC__gfFieldHandler);
jQuery(document).on('focus', '.ginput_container input', FC__gfFieldHandler);
jQuery(document).on('focusout', '.ginput_container input', FC__gfFieldHandler);
jQuery(document).on('click', '.ginput_container textarea', FC__gfFieldHandler);
jQuery(document).on('focus', '.ginput_container textarea', FC__gfFieldHandler);
jQuery(document).on('focusout', '.ginput_container textarea', FC__gfFieldHandler);
jQuery(document).on('gform_post_render', FC__gfFieldHandler);
function FC__gfFieldHandler() {
  // Looping through forms
  jQuery(document).find('.gform_wrapper').each(function () {
    // Looping through fields
    jQuery(this)
      .find(".gfield")
      .each(function () {
        let field = jQuery(this);
        // If determining if the field is a simple field or a fieldset
        let tagName = field.prop("tagName");
        if (tagName === "FIELDSET") {
          FC__gfFieldsetHandler(field);
        } else {
          FC__gfInputHandler(field);
        }
      });
  });
}

function FC__gfInputHandler(field) {
  // If field is undefined for any reason
  if (!field) return;
  // Select the first (and should be only) element in the fields input wrapper
  let val = field.find(".ginput_container > :first-child").val();
  // Checking if the field has a value
  if (val) {
    // Adding active class if so
    field.addClass("active");
  } else {
    // Removing it if not
    field.removeClass("active");
  }
}

function FC__gfFieldsetHandler(fieldset) {
  if(!fieldset) return;
  fieldset.find('input').each(function() {
    let val = jQuery(this).val();
    if(val) {
      jQuery(this).closest('span').addClass('active');
    } else {
      jQuery(this).closest('span').removeClass('active');
    }
  });
}