import Swal from "sweetalert2";

export default class Flash extends HTMLElement {
  async connectedCallback() {
    await Swal.fire({
      toast: true,
      position: "top-end",
      icon: "success",
      title: "Your work has been saved",
      howCloseButton: true,
      timerProgressBar: true,
      showConfirmButton: false,
      didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
      },
      timer: 3000,
    });
  }
}
