import { LitElement, html } from "lit";
import { customElement, property } from "lit/decorators.js";

@customElement("navbar-element")
export class MyElement extends LitElement {
  createRenderRoot() {
    return this;
  }

  isActiveLink(href: string): boolean {
    return window.location.pathname.endsWith(href);
  }

  render() {
    return html`
      <nav
        class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark"
        style="z-index: 2000;"
      >
        <div class="container-fluid">
          <!-- Navbar brand -->
          <a
            class="navbar-brand nav-link ${this.isActiveLink("index.html")} "
            href="index.html"
          >
            <strong>Rewind-IT</strong>
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarExample01"
            aria-controls="navbarExample01"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fas fa-bars"></i>
          </button>
          <div
            class="collapse navbar-collapse justify-content-end"
            id="navbarExample01"
          >
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a
                  class="nav-link ${this.isActiveLink("diensten.html")
                    ? "active"
                    : ""}"
                  href="diensten.html"
                  >Diensten</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link ${this.isActiveLink("overons.html")
                    ? "active"
                    : ""}"
                  href="overons.html"
                  >Over Ons</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link ${this.isActiveLink("contact.php")
                    ? "active"
                    : ""}"
                  href="contact.php"
                  >Contact</a
                >
              </li>
            </ul>
          </div>
        </div>
      </nav>
    `;
  }
}
