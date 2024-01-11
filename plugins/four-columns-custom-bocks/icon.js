(function () {
  var el = wp.element.createElement;
  var SVG = wp.primitives.SVG;
  var circle = el("circle", {
    cx: 10,
    cy: 10,
    r: 10,
    fill: "red",
    stroke: "blue",
    strokeWidth: "10",
  });
  var svgIcon = el(
    SVG,
    { width: 20, height: 20, viewBox: "0 0 20 20" },
    circle
  );
  wp.blocks.updateCategory("my-category", { icon: svgIcon });
})();
