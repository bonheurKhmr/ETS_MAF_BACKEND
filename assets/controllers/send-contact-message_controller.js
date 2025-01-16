import { Controller } from "@hotwired/stimulus";
import axios from "axios";

/*
 * The following line makes this controller "lazy": it won't be downloaded until needed
 * See https://github.com/symfony/stimulus-bridge#lazy-controllers
 */
/* stimulusFetch: 'lazy' */
export default class extends Controller {
  connect() {
    this.element.addEventListener("submit", this.sendMessage);
  }

  /**
   *
   * @param {PointerEvent} e
   */
  sendMessage = (e) => {
    e.preventDefault();
    e.stopPropagation();
    const target = e.target;
    const data = new FormData(target);
    //axios.get("http://127.0.0.1:8000/api/entreprise");
    axios.post(target.getAttribute("action"), data).then((data) => {
      console.log(data);
    });
  };
}
