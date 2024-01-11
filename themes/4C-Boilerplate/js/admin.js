/* === Admin Scripts === */
jQuery(document).ready(function () {
  /* == Adding Download Media Button == */
  FCBP__generateDownloadButton();
  jQuery(document).on("click", ".attachment", FCBP__generateDownloadButton);
  jQuery(document).on("click", ".left", FCBP__generateDownloadButton);
  jQuery(document).on("click", ".right", FCBP__generateDownloadButton);
  jQuery(document).on("mousemove", FCBP__generateDownloadButton);
});

/**
 * This function generates the "Download Media" button on the
 * attachment details modal
 */
function FCBP__generateDownloadButton() {
  setTimeout(function () {
    if (jQuery(".copy-to-clipboard-container").length && !jQuery('.download-media-button').length) {
      var url = jQuery("#attachment-details-two-column-copy-link").val();
      url = FCBP__generateRelativeLink(url);
      jQuery(".copy-to-clipboard-container").append(
        '<a class="download-media-button button button-small copy-attachment-url" href="' +
          url +
          '" download>Download Media</a>'
      );
    }
  }, 200);
}

/**
 * This function generates a relative link from a absolute url
 * @param {String} absoluteLink - The url of the absolute link
 * @returns String
 */
function FCBP__generateRelativeLink(absoluteLink) {
  const a = document.createElement("a");
  a.href = absoluteLink;
  const relativeLink = a.pathname + a.search + a.hash;
  return relativeLink;
}