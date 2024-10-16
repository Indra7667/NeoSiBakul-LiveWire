function multiToast(
    title = "any string",
    labels = ["anyString1", "anyString2"],
    icon = "warning"
) {
    let combinedMessage = "";
    labels.forEach((label) => {
        combinedMessage += `${label} <br>`;
    });
    singularToast(title, combinedMessage, icon);
}


function multiGroupedToast(
    title = "any string",
    labels = {
        anyString1: { item: "anyString" },
        anyString2: { item: "anyString" },
    },
    icon = "warning"
) {
    let combinedMessage = "";
    labels.forEach((label) => {
        const [key, value] = label;
        combinedMessage += `${key}:`;
        value.forEach((element) => {
            combinedMessage += `${element} <br>`;
        });
    });
    singularToast(title, combinedMessage, icon);
}


function singularToast(
    title = "any string",
    label = "any string",
    icon = "warning"
) {
    Swal.fire({
        title: title,
        html: label,
        icon: icon, //"success", "error", "warning", "info", "question"
    });
}
