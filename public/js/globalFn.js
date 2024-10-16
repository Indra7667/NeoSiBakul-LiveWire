function createDate(dateRaw, locale='id') {
    try {
        let result = {
            raw: Intl.DateTimeFormat(locale, { dateStyle: "full" }).formatToParts(
                Date.parse(dateRaw)
            ),
        };
        // result.string = `${toString(result.raw.weekday)}, ${toString(result.raw.day)+toString(result.raw.month)+toString(result.raw.year)}`;
        result.string = "";
        result.raw.forEach((parts) => {
            result.string += parts.value;
        });
        // console.log(result);
        return result;
    } catch (error) {
        console.error(error);
    }
}
