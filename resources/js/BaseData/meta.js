const metaData = {
    title: 'PROJECTS',
    sidebar: [
        {icon: '', label: 'analytics', url: ''},
        {icon: 'chart-bar', label: 'dashboard', url: '/', component: 'Dashboard/Index'},
        {icon: '', label: 'projects', url: ''},
        {
            icon: 'credit-card',
            label: 'project owners',
            url: '/project-owners',
            component: 'Dashboard/ProjectOwners/List'
        },
        {icon: 'code', label: 'projects', url: '/projects', component: 'Dashboard/Projects/List'},
        {icon: 'dollar', label: 'payments', url: '/payments', component: 'Dashboard/Payments/List'},
        {icon: '', label: 'administration', url: ''},
        {icon: 'users', label: 'user groups', url: '/user-groups', component: 'Dashboard/Administration/UserGroups'},
        {icon: 'user', label: 'users', url: '/users', component: 'Dashboard/Administration/Users'},
        {icon: 'wrench', label: 'settings', url: '/settings', component: 'Dashboard/Administration/Settings'},
    ]
}
export default metaData;
