import { rest } from 'msw';

export const handlers = [
    rest.get('/api/get-content', (_req, res, ctx) => {
        const htmlContent = `
          <div id="c304" class="frame frame-default frame-type-mediaconsent_cns frame-layout-0">
            <div class="mediaconsent_element">
              <h1>
                <a href="https://www.youtube.com/watch?v=SAi677zpGMk&amp;list=PL-sDBIrOKGObd1RVYG53sQWPtr4dwBmV6">Media Consent CType SSS</a>
              </h1>
              <iframe width="560" height="315" src="https://www.youtube.com/embed/SJU3-UszJSs?si=IFiQLv72y_qdUPNj" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
          </div>
        `;
        return res(ctx.text(htmlContent));
    }),
];