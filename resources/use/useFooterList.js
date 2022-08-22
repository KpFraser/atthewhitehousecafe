export default function useFooterList () {
    const footerLists = [
        {label: 'surveys', class: 'far fa-file-invoice', to: 'surveys_home'},
        {label: 'projects', class: 'fal fa-lightbulb-on', to: 'project'},
        {label: 'relationships', class: 'fal fa-user-friends', to: 'dashboard'},
        {label: 'accounts', class: 'fas fa-user-circle', to: 'dashboard'},
    ]
    return { footerLists }
}
