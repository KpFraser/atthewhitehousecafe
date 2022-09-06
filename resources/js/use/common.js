import { inject } from "vue";

export default function commonFunctions() {

    const Swal = inject('$swal'),
        Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        }),

        ConfirmToast = Swal.mixin({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Project!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Delete !",
            cancelButtonText: "Cancel !",
            closeOnConfirm: false,
            closeOnCancel: false

        })

    return {
        Toast, ConfirmToast
    }
}
