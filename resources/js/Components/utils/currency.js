const formatter = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0,
});

export const formatRupiah = (value) => {
    if (value == null || value === "") return "-";
    return formatter.format(value);
};
