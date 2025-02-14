import './bootstrap';

function zoomImage(img) {
    var modal = document.createElement("div");
    modal.style.position = "fixed";
    modal.style.top = "0";
    modal.style.left = "0";
    modal.style.width = "100%";
    modal.style.height = "100%";
    modal.style.backgroundColor = "rgba(0, 0, 0, 0.8)";
    modal.style.display = "flex";
    modal.style.alignItems = "center";
    modal.style.justifyContent = "center";
    modal.style.zIndex = "9999";

    var modalImg = document.createElement("img");
    modalImg.src = img.src;
    modalImg.style.maxWidth = "90%";
    modalImg.style.maxHeight = "90%";

    modal.appendChild(modalImg);
    document.body.appendChild(modal);

    modal.onclick = function() {
      document.body.removeChild(modal);
    };
  }

import $ from 'jquery';
window.$ = $;
