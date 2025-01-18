import { Controller } from "@hotwired/stimulus";
import axios from "axios";
import alert from "../utils/alert";
import { addLoaderBtn, removeReloadBtn } from "../utils/loader";

/*
 * The following line makes this controller "lazy": it won't be downloaded until needed
 * See https://github.com/symfony/stimulus-bridge#lazy-controllers
 */
/* stimulusFetch: 'lazy' */
export default class extends Controller {
  connect() {
    this.element.addEventListener("submit", this.addRole);
  }

  /**
   *
   * @param {PointerEvent} e
   */
  addRole(e) {
    e.preventDefault();
    const target = e.target;
    const saveRole = target.querySelector("#saveRole");
    addLoaderBtn(saveRole);
    const data = new FormData(target);
    axios.post(target.getAttribute("action"), data).then((data) => {
      removeReloadBtn(saveRole);
      alert("success", data.data.success);
    });
  }
}
