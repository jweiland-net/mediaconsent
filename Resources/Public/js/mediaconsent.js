let clickHandler = function (event) {
  let scpType = this.getAttribute('data-mctype');
  let mediaconsentWrappers = document.querySelectorAll('.mediaconsent_wrapper[data-mctype="' + scpType + '"]');
  mediaconsentWrappers.forEach(function (mediaconsentWrapper) {
    mcNsp.reloadItem(mediaconsentWrapper);
  });
};

var mcNsp = (function () {
  function MediaItem (element) {
    this.element = element;

    this.reload = function () {
      let xhr = new XMLHttpRequest();
      xhr.open('GET', this.element.getAttribute('data-mcuri'), true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          this.element.removeEventListener('click', clickHandler);
          this.element.innerHTML = xhr.responseText;
          this.element.addEventListener('click', clickHandler);
        }
      }.bind(this);
      xhr.send();
    };
  }

  return {
    reloadItem: function (item) {
      var mediaItem = new MediaItem(item);
      mediaItem.reload();
    }
  };
})();

window.onload = function () {
  var mediaconsentWrappers = document.getElementsByClassName('mediaconsent_wrapper');
  Array.from(mediaconsentWrappers).forEach(function (mediaconsentWrapper) {
    mediaconsentWrapper.addEventListener('click', clickHandler);
  });
};
