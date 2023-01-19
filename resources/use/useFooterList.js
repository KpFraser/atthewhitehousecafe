
export default function useFooterList () {
    const footerLists = [
        {label: 'Plan', to: 'footer-project'},
        {label: 'Do', to: 'surveys_home'},
        {label: 'Review', to: 'dashboard'},
        {label: 'Account', to: 'dashboard'},
    ]
    return { footerLists }
}

