export default function useFooterList () {
    const footerLists = [
        {label: 'surveys', class: 'far fa-file-invoice'},
        {label: 'projects', class: 'fal fa-lightbulb-on'},
        {label: 'relationships', class: 'fal fa-user-friends'},
        {label: 'accounts', class: 'fas fa-user-circle'},
    ]
    return { footerLists }
}
