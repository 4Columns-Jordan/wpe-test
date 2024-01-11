// Defining the ajax variable
var FCBL__ajaxPosts = [];
jQuery(function ($) {
  $(document).ready(function () {
    // Default current page number to 1.
    var currentPage = 1;
    // Loop through each ajax post block array.
    FCBL__ajaxPosts.forEach((ajaxPost) => {
      // Convert the ID string to a jQuery selector.
      ajaxPost.id = jQuery("#" + ajaxPost.id);
      // Retrieve posts from AJAX endpoint.
      $.ajax({
        type: "POST",
        url: ajaxPost.ajaxurl,
        dataType: "json", // Specify the expected data type as JSON.
        data: {
          action: "get_posts_ajax", // Ajax action
          postsPerPage: ajaxPost.postsPerPage, // Posts per page
          postType: ajaxPost.postType, // Post type
          cat: ajaxPost.category, // Post category (is applicable)
        },
        success: function (response) {
          // Loop through the posts in the response.
          response.posts.forEach((res) => {
            // Append each post to the AJAX post wrapper.
            ajaxPost.id
              .find(".ajax__postWrapper")
              .append(ajaxPosts__buildTemplate(res));
          });
          // Remove the loading spinner.
          ajaxPost.id.find(".ajax__loading").remove();
          // Check if the number of retrieved posts is greater than or equal to the total number of posts.
          if (response.posts.length >= parseInt(response.totalPosts)) {
            // If true, remove the "Load More" button.
            ajaxPost.id.find(".ajaxLoad").remove();
          }
        },
      });
      // Attach a click event handler to the "Load More" button.
      ajaxPost.id.find(".ajaxLoad").on("click", (e) => {
        e.preventDefault; // Prevent the default link behavior.
        currentPage++; // Increment the current page number.
        loadPage(ajaxPost, currentPage); // Load more posts.
      });
    });
  });
});

/**
 * Sends an AJAX request to retrieve more posts.
 *
 * @param {Object} ajaxPost - The AJAX post element configuration.
 * @param {number} cPage - The current page number to load.
 */
function loadPage(ajaxPost, cPage) {
  // Retrieve posts from AJAX endpoint.
  jQuery.ajax({
    type: "POST",
    url: ajaxPost.ajaxurl,
    dataType: "json",
    data: {
      action: "get_posts_ajax",
      page: cPage, // Specify the current page number.
      postsPerPage: ajaxPost.postsPerPage, // Posts per page
      postType: ajaxPost.postType, // Post type
      cat: ajaxPost.category, // Post category (is applicable)
    },
    success: function (response) {
      // Loop through the retrieved posts in the response.
      response.posts.forEach((res) => {
        // Append each post to the AJAX post wrapper.
        ajaxPost.id
          .find(".ajax__postWrapper")
          .append(ajaxPosts__buildTemplate(res));
      });
      // Check if the number of retrieved posts is less than the specified posts per page.
      if (response.posts.length < ajaxPost.postsPerPage) {
        // If true, remove the "Load More" button.
        ajaxPost.id.find(".ajaxLoad").remove();
      }
    },
  });
}

/**
 * This function takes the response and uses template literalls to
 * build a string of HTML content.
 *
 * @param {Object} res - OBJ - ajaxPost Response Object
 * @returns STR - String of HTML content
 */
function ajaxPosts__buildTemplate(res) {
  return `
    <div class="col-lg-4 col-sm-2 ajax__post">
        <a href="${res.url}" class="more-link" title="Read More">
            <div class="ajaxPost__imageWrapper">
                <img src="${res.thumb}" class="ajaxPost__image" alt="">
            </div>
            <div class="loop-post_content">
                <div class="news__metaContainer">
                    <div class="ajaxPost__meta"><span>${res.date}</span></div>
                </div>
                <h2 class="ajaxPost__title">${res.title}</h2>
                <p class="ajaxPost__excerpt">${res.excerpt}</p>
                <div class="ajaxPost__buttonWrapper">
                    <p class="custom__button">Read More</p>
                </div>
            </div>
        </a>
    </div>
    `;
}
