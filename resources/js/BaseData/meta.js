const metaData = {
    title: 'PROJECTS',
    sidebar: [
        // {icon: '', label: 'analytics', url: ''},
        // {icon: 'chart-bar', label: 'dashboard', url: '/', component: 'Dashboard/Index'},
        {icon: '', key: 'project', label: 'projects', url: ''},
        {
            icon: 'credit-card',
            label: 'project owners',
            key: 'project_owners',
            url: '/project-owners',
            component: 'Dashboard/ProjectOwners/List'
        },
        {icon: 'code', key: 'project_projects', label: 'projects', url: '/projects', component: 'Dashboard/Projects/List'},
        {icon: 'dollar', key: 'project_payments', label: 'payments', url: '/payments', component: 'Dashboard/Payments/List'},
        {icon: '', key: 'administration', label: 'administration', url: ''},
        {icon: 'users', key: 'administration_user_groups', label: 'user groups', url: '/usergroups', component: 'Dashboard/Administration/UserGroups'},
        {icon: 'user', key: 'administration_users', label: 'users', url: '/users', component: 'Dashboard/Administration/Users'},
        {icon: 'building', label: 'companies', key: 'administration_companies', url: '/companies', component: 'Dashboard/Companies'},
        {icon: 'wrench', key: 'adminsitration_settings', label: 'settings', url: '/settings', component: 'Dashboard/Administration/Settings'},
    ]
}
export default metaData;
