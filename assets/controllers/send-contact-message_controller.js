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
    this.element.addEventListener("submit", this.sendMessage);
  }

  /**
   *
   * @param {PointerEvent} e
   */
  sendMessage = (e) => {
    e.preventDefault();
    const target = e.target;
    const sendBtn = target.querySelector("#send-btn");
    addLoaderBtn(sendBtn);
    const data = new FormData(target);
    axios.post(target.getAttribute("action"), data).then((data) => {
      target.querySelector("#first_name").value = "";
      target.querySelector("#email").value = "";
      target.querySelector("#message").value = "";
      removeReloadBtn(sendBtn);
      alert("success", data.data.success);
    });
  };
}
