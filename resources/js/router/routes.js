function page(path) {
  return () =>
    import(/* webpackChunkName: '' */ `~/pages/${path}`).then(
      m => m.default || m
    );
}

export default [
  { path: "/", name: "welcome", component: page("welcome.vue") },

  { path: "/login", name: "login", component: page("auth/login.vue") },
  { path: "/register", name: "register", component: page("auth/register.vue") },
  {
    path: "/password/reset",
    name: "password.request",
    component: page("auth/password/email.vue")
  },
  {
    path: "/password/reset/:token",
    name: "password.reset",
    component: page("auth/password/reset.vue")
  },
  {
    path: "/email/verify/:id",
    name: "verification.verify",
    component: page("auth/verification/verify.vue")
  },
  {
    path: "/email/resend",
    name: "verification.resend",
    component: page("auth/verification/resend.vue")
  },

  { path: "/home", name: "home", component: page("home.vue") },
  {
    path: "/quotes",
    name: "add a quote",
    component: page("quotes/create.vue")
  },
  {
    path: "/quotes/list",
    name: "list of quotes",
    component: page("quotes/list.vue")
  },
  {
    path: "/quotes/edit/:id",
    name: "edit a quote",
    component: page("quotes/edit.vue")
  },
  {
    path: "/employees",
    name: "list of employees",
    component: page("employees.vue")
  },
  {
    path: "/jobs",
    name: "add a job",
    component: page("jobs/create.vue")
  },
  {
    path: "/jobs/list",
    name: "list the jobs",
    component: page("jobs/list.vue")
  },
  {
    path: "/settings",
    component: page("settings/index.vue"),
    children: [
      { path: "", redirect: { name: "settings.profile" } },
      {
        path: "profile",
        name: "settings.profile",
        component: page("settings/profile.vue")
      },
      {
        path: "password",
        name: "settings.password",
        component: page("settings/password.vue")
      },
      {
        path: "configure",
        name: "settings.configure",
        component: page("settings/configure.vue")
      },
      {
        path: "customers",
        name: "settings.customers",
        component: page("settings/customers.vue")
      }
    ]
  },

  { path: "*", component: page("errors/404.vue") }
];
