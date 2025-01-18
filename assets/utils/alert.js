import Swal from "sweetalert2";

/**
 * show the alert message to the users
 * @param {string} type
 * @param {string} message
 */
export default function (type, message) {
  Swal.fire({
    toast: true,
    position: "top-end",
    icon: type,
    title: message,
    timerProgressBar: true,
    showConfirmButton: false,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
    timer: 5000,
  });
}
