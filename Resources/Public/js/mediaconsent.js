const mcClickHandler = (event) => {
  const mcScpType = event.target.getAttribute('data-mctype');
  const mcMediaconsentWrappers = document.querySelectorAll('.mediaconsent_wrapper[data-mctype="' + mcScpType + '"]');
  mcMediaconsentWrappers.forEach(mcMediaconsentWrapper => {
    mcNsp.reloadItem(mcMediaconsentWrapper);
  });
};

const mcNsp = (() => {
  function McMediaItem(element) {
    this.element = element;

    this.reload = () => {
      fetch(this.element.getAttribute('data-mcuri'))
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.text();
        })
        .then(text => {
          this.element.removeEventListener('click', mcClickHandler);
          this.element.innerHTML = text;
          this.element.addEventListener('click', mcClickHandler);
        })
        .catch(error => {
          console.error('There was a problem with the fetch operation:', error);
        });
    };
  }

  return {
    reloadItem: (item) => {
      const mcMediaItem = new McMediaItem(item);
      mcMediaItem.reload();
    }
  };
})();

window.addEventListener('load', () => {
  const mcMediaconsentWrapper = document.querySelector('.mediaconsent_wrapper');
  mcMediaconsentWrapper.addEventListener('click', mcClickHandler);
});
