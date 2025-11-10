import './bootstrap';
import Swal from "sweetalert2";
import 'sweetalert2/dist/sweetalert2.min.css';

window.flashMessage = function (type, message) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        customClass: {
            title: "text-sm font-medium",
        },
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });

    Toast.fire({
        icon: type,
        title: message,
    });
};
