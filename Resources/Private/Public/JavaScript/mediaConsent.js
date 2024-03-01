// media-consent module
export class MediaConsent {
    constructor(element) {
        this.clickHandler = () => {
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
        this.element = element;
        this.wrapper = element.closest('.mediaconsent_wrapper');
        if (!this.wrapper) {
            throw new Error('Parent wrapper with class "mediaconsent-wrapper" not found.');
        }
        this.uri = this.wrapper.dataset.mcuri;
        this.type = this.wrapper.dataset.mctype;
        this.wrapper.addEventListener('click', this.clickHandler);
    }
    reloadItem() {
        fetch(this.uri)
            .then(response => {
            if (!response.ok) {
                throw new Error('MediaConsent: Failed to load consent content');
            }
            return response.text();
        })
            .then(text => {
            this.wrapper.innerHTML = text;
        })
            .catch(error => {
            console.error('There is a problem with the fetch operation: ', error);
        });
    }
}
document.addEventListener('DOMContentLoaded', () => {
    const mediaCheckBoxs = document.querySelectorAll('[name="mcb"]');
    mediaCheckBoxs.forEach(mediaCheckBox => {
        new MediaConsent(mediaCheckBox);
    });
});
