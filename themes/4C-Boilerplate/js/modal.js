jQuery(document).ready(function () {
  jQuery(".fcbp_modal__overlay").each(function () {
    jQuery(this).appendTo("body");
  });
  jQuery(".fcbp_modal__open").attr("title", "Open Modal");

  jQuery(".fcbp_modal__open").click(function (e) {
    e.preventDefault();
    var mId = jQuery(this).attr("modal-id");
    FCBP__openModal(mId);
  });

  jQuery(".fcbp_modal__modal").click(function (e) {
    e.stopPropagation();
  });

  jQuery(".fcbp_modal__overlay").click(function () {
    FCBP__closeModal();
  });

  jQuery(".fcbp_modal__close_out").click(function () {
    FCBP__closeModal();
  });

  jQuery(".fcbp_modal__close_out").on("keypress", function () {
    FCBP__closeModal();
  });
});

jQuery(document).on("keyup", function (e) {
  if (e.key == "Escape") {
    FCBP__closeModal();
  }
});

function FCBP__openModal(id) {
  jQuery(".fcbp_modal__overlay").removeClass("active");
  jQuery(".fcbp_modal__overlay").each(function () {
    if (jQuery(this).attr("modal-id") === id) {
      jQuery(this).addClass("active");
    }
  });
}

function FCBP__closeModal() {
  jQuery(".fcbp_modal__overlay").removeClass("active");
}
