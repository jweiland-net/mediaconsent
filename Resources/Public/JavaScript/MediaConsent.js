<<<<<<< HEAD
const mcClickHandler = (event) => {
  const mcScpType = event.target.getAttribute('data-mctype');
  const mcMediaconsentWrappers = document.querySelectorAll(`.mediaconsent_wrapper[data-mctype="${mcScpType}"]`);
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
          return response;
        })
        .then(response => response.text())
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

document.addEventListener('DOMContentLoaded', () => {
  const mcMediaconsentWrappers = document.querySelectorAll('.mediaconsent_wrapper');
  mcMediaconsentWrappers.forEach(mcMediaconsentWrapper => {
    mcMediaconsentWrapper.addEventListener('click', mcClickHandler);
  });
});
=======
var a=Object.defineProperty;var i=(t,e,r)=>e in t?a(t,e,{enumerable:!0,configurable:!0,writable:!0,value:r}):t[e]=r;var n=(t,e,r)=>(i(t,typeof e!="symbol"?e+"":e,r),r);class o{constructor(e){n(this,"wrapper");n(this,"uri");n(this,"type");n(this,"clickHandler",()=>{if(!this.uri){console.error("Error: data-mcuri attribute not found in parent wrapper.");return}if(!this.type){console.warn('Warning: "type" parameter not found in data-mcuri attribute.');return}this.reloadItem()});if(this.wrapper=e.closest(".mediaconsent_wrapper"),this.wrapper)this.uri=this.wrapper.dataset.mcuri,this.type=this.wrapper.dataset.mctype;else throw new Error('Parent wrapper with class "mediaconsent-wrapper" not found.');this.wrapper.addEventListener("click",this.clickHandler.bind(this))}reloadItem(){fetch(this.uri).then(e=>{if(!e.ok)throw new Error("MediaConsent: Failed to load consent content");return e.text()}).then(e=>{this.wrapper.innerHTML=e}).catch(e=>{console.error("There is a problem with the fetch operation: ",e)})}}document.addEventListener("DOMContentLoaded",()=>{document.querySelectorAll('[name="mcb"]').forEach(e=>{new o(e)})});
//# sourceMappingURL=MediaConsent.js.map
>>>>>>> 90d52fa (Build files updated)
