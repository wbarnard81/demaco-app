<template>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-3">
        <card :title="'Settings'" class="settings-card">
          <ul class="nav flex-column nav-pills">
            <li v-for="tab in tabs" :key="tab.route" class="nav-item">
              <router-link
                :to="{ name: tab.route }"
                class="nav-link text-success"
                active-class="active"
              >
                <fa :icon="tab.icon" fixed-width />
                {{ tab.name }}
              </router-link>
            </li>
          </ul>
        </card>
      </div>

      <div class="col-md-8">
        <transition name="fade" mode="out-in">
          <router-view />
        </transition>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  middleware: 'auth',

  computed: {
    tabs () {
      return [
        {
          icon: 'user',
          name: 'Profile',
          route: 'settings.profile'
        },
        {
          icon: 'lock',
          name: 'Password',
          route: 'settings.password'
        },
        {
          icon: 'sliders-h',
          name: 'Configure',
          route: 'settings.configure'
        },
        {
          icon: 'user-tie',
          name: 'Customers',
          route: 'settings.customers'
        }
      ]
    }
  }
}
</script>

<style>
.settings-card .card-body {
  padding: 0;
}

.active {
  background-color: #28a745 !important;
  color: white !important;
}
</style>
