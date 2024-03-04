// Import global styles
import './scss/style.scss';

// Import assets
// @ts-ignore
import jweilandLogo from './assets/jweilandnet.svg';

// Import TypeScript files
import './ts/mediaConsent.ts';

// Import mock browser data if environment is development
if (process.env.NODE_ENV !== 'production') {
  import('./mocks/browser.ts');
}

// Define root element
const appRoot = document.querySelector<HTMLDivElement>('#app');

// Create HTML content
const htmlContent = `
  <div>
    <a href="https://jweiland.net/" target="_blank">
      <img src="${jweilandLogo}" class="logo vanilla" alt="Jweiland Logo" />
    </a>
    <h1>TYPO3 Extension: MediaConsent from Jweiland.net</h1>
    <div class="mediaConsent">
      <div class="mediaconsent_element">
        <div class="mediaconsent_wrapper"
             data-mcuri="/api/get-content"
             data-mctype="4">
          <h1>
            <a href="#">Media Consent CType</a>
          </h1>
          <label for="mcb-elem-1">
            <input id="mcb-elem-1" class="mcb" type="checkbox" name="mcbProvider"/>
            Show content from
          </label>
        </div>
      </div>
    </div>
  </div>
`;

// Set inner HTML of root element
if (appRoot) {
  appRoot.innerHTML = htmlContent;
} else {
  console.error('Root element "#app" not found.');
}
