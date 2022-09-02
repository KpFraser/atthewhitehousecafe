
export default function useFooterList () {
    const footerLists = [
        {label: 'projects', class: 'fal fa-lightbulb-on', to: 'footer-project'},
        {label: 'surveys', class: 'far fa-file-invoice', to: 'surveys_home'},
        {label: 'relationships', class: 'fal fa-user-friends', to: 'dashboard'},
        {label: 'accounts', class: 'fas fa-user-circle', to: 'dashboard'},
    ]
    return { footerLists }
}

