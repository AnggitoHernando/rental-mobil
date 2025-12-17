import Swal from "sweetalert2";

const swal = Swal.mixin({
    confirmButtonColor: "#2563EB",
    cancelButtonColor: "#94A3B8",
    confirmButtonText: "Ya",
    cancelButtonText: "Batal",
    reverseButtons: true,
});

export default swal;
