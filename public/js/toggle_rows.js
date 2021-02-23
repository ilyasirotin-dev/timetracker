function toggleRows() {
    $$('#hours_log tr').each(function ($row, index) {
        if (index > 0) {
            if ($row.hasClass('today')) {
                return;
            } else {
                $row.toggleClass('display_none');
            }
        }
    });
}

window.addEvent('domready', function () {
    toggleRows();
});