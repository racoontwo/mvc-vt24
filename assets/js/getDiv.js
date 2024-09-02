
export function getVisibleDivIds() {
    const visibleDivs = Array.from(document.querySelectorAll('div')).filter(div => {
        const style = window.getComputedStyle(div);
        return style.display !== 'none' && style.visibility !== 'hidden' && style.opacity !== '0';
    });

    return visibleDivs.map(div => div.id).filter(id => id !== '');
}
