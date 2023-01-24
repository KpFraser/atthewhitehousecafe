
export default function useFooterList () {
    const footerLists = [
        {label: 'Plan', to: 'plan'},
        {label: 'Do', to: 'display-projects'},
        {label: 'Review', to: 'dashboard'},
        {label: 'Account', to: 'dashboard'},
    ]
    return { footerLists }
}

