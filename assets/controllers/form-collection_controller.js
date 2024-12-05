import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
  static value = {
    addLabel: String,
    deleteLabel: String,
  };

  connect() {
    const button = document.createElement("button");
    button.setAttribute("class", "btn btn-secondary");
    button.innerText = this.addLabelValue || "ajouter";
    button.setAttribute("type", "button");
    button.addEventListener("click", this.addElement);
    //this.element.childNodes.forEach(this.addDeleteButton);
    this.element.append(button);
  }

  /**
   * @param {MouseEvent} e
   */
  addElement(e) {
    e.preventDefault();
    let index = this.parentNode.childElementCount;
    const element = document
      .createRange()
      .createContextualFragment(
        this.parentNode.dataset["prototype"].replaceAll("__name__", index)
      ).firstElementChild;

    //this.addDeleteButton(element);
    index++;
    e.currentTarget.insertAdjacentElement("beforebegin", element);
  }

  /**
   * @param {HTMLElement} item
   */
  addDeleteButton = (item) => {
    const button = document.createElement("button");
    button.setAttribute("class", "btn btn-secondary");
    button.innerText = this.deleteLabelValue || "supprime";
    button.setAttribute("type", "button");
    item.append(button);
    button.addEventListener("click", (e) => {
      e.preventDefault();
      item.remove();
    });
  };
}
