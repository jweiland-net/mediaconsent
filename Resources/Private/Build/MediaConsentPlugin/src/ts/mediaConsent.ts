// media-consent module
export class MediaConsent {
  private readonly wrapper: HTMLElement | null;
  private readonly uri: string | null; // Declare the uri property with the correct type
  private readonly type: string | null; // Declare the uri property with the correct type

  constructor (element: Element) {
    this.wrapper = element.closest('.mediaconsent_wrapper') as HTMLElement | null;
    if (!this.wrapper) {
      throw new Error('Parent wrapper with class "mediaconsent-wrapper" not found.');
    } else {
      this.uri = this.wrapper.dataset.mcuri as string;
      this.type = this.wrapper.dataset.mctype as string;
    }
    this.wrapper.addEventListener('click', this.clickHandler.bind(this));
  }

  clickHandler = () => {
    if (!this.uri) {
      console.error('Error: data-mcuri attribute not found in parent wrapper.');
      return;
    }
    if (!this.type) {
      console.warn('Warning: "type" parameter not found in data-mcuri attribute.');
      return;
    }
    this.reloadItem();
  };

  reloadItem () {
    if (this.uri !== null) {
      fetch(this.uri)
        .then(response => {
          if (!response.ok) {
            throw new Error('MediaConsent: Failed to load consent content');
          }
          return response.text();
        })
        .then(text => {
          if (this.wrapper !== null) {
            this.wrapper.innerHTML = text;
          } else {
            console.error('Error: Wrapper element is null.');
          }
        })
        .catch(error => {
          console.error('There is a problem with the fetch operation: ', error);
        });
    }
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const mediaCheckBoxs = document.querySelectorAll('.mcb');
  mediaCheckBoxs.forEach(mediaCheckBox => {
    new MediaConsent(mediaCheckBox);
  });
});
