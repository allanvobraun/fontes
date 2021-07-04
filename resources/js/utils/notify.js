import Swal from "sweetalert2";

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})


const notify = {
  sucess(title, text = '') {
    Toast.fire({
      icon: 'success',
      title,
      text
    });
  },

  info(title, text = '') {
    Toast.fire({
      icon: 'info',
      title,
      text
    });
  },

  error(title, text = '') {
    Toast.fire({
      icon: 'error',
      title,
      text
    });
  }
};

export default notify;
