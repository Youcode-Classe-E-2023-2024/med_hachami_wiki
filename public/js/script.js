const setup = () => {
    const getTheme = () => {
      if (window.localStorage.getItem('dark')) {
        return JSON.parse(window.localStorage.getItem('dark'))
      }
      return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
    }
  
    const setTheme = (value) => {
      window.localStorage.setItem('dark', value)
    }
  
    const getColor = () => {
      if (window.localStorage.getItem('color')) {
        return window.localStorage.getItem('color')
      }
      return 'cyan'
    }
  
    const setColors = (color) => {
      const root = document.documentElement
      root.style.setProperty('--color-primary', `var(--color-${color})`)
      root.style.setProperty('--color-primary-50', `var(--color-${color}-50)`)
      root.style.setProperty('--color-primary-100', `var(--color-${color}-100)`)
      root.style.setProperty('--color-primary-light', `var(--color-${color}-light)`)
      root.style.setProperty('--color-primary-lighter', `var(--color-${color}-lighter)`)
      root.style.setProperty('--color-primary-dark', `var(--color-${color}-dark)`)
      root.style.setProperty('--color-primary-darker', `var(--color-${color}-darker)`)
      this.selectedColor = color
      window.localStorage.setItem('color', color)
    }
  
    return {
      loading: true,
      isDark: getTheme(),
      color: getColor(),
      selectedColor: 'cyan',
      toggleTheme() {
        this.isDark = !this.isDark
        setTheme(this.isDark)
      },
      setLightTheme() {
        this.isDark = false
        setTheme(this.isDark)
      },
      setDarkTheme() {
        this.isDark = true
        setTheme(this.isDark)
      },
      setColors,
      toggleSidbarMenu() {
        this.isSidebarOpen = !this.isSidebarOpen
      },
      isSettingsPanelOpen: false,
      openSettingsPanel() {
        this.isSettingsPanelOpen = true
        this.$nextTick(() => {
          this.$refs.settingsPanel.focus()
        })
      },
      isNotificationsPanelOpen: false,
      openNotificationsPanel() {
        this.isNotificationsPanelOpen = true
        this.$nextTick(() => {
          this.$refs.notificationsPanel.focus()
        })
      },
      isSearchPanelOpen: false,
      openSearchPanel() {
        this.isSearchPanelOpen = true
        this.$nextTick(() => {
          this.$refs.searchInput.focus()
        })
      },
      isMobileSubMenuOpen: false,
      openMobileSubMenu() {
        this.isMobileSubMenuOpen = true
        this.$nextTick(() => {
          this.$refs.mobileSubMenu.focus()
        })
      },
      isMobileMainMenuOpen: false,
      openMobileMainMenu() {
        this.isMobileMainMenuOpen = true
        this.$nextTick(() => {
          this.$refs.mobileMainMenu.focus()
        })
      },
    }
  }
  
// chart js

const dataDoughnut = {
  labels: ["JavaScript", "Python", "Ruby"],
  datasets: [
    {
      label: "My First Dataset",
      data: [300, 50, 100],
      backgroundColor: [
        "rgb(133, 105, 241)",
        "rgb(164, 101, 241)",
        "rgb(101, 143, 241)",
      ],
      hoverOffset: 4,
    },
  ],
};
const configDoughnut = {
  type: "doughnut",
  data: dataDoughnut,
  options: {
    plugins: {
      doughnutlabel: {
        labels: [
          {
            text: 'Chart.js Doughnut Chart',
            font: {
              size: 20,
            },
            position: 'center',
          },
        ],
      },
    },
    width: 600,
    height: 600,
    responsive: false, // Disable responsiveness
  },
};

var chartDoughnut = new Chart(
  document.getElementById("chartDoughnut"),
  configDoughnut
);
const dataLine = {
  labels: ["January", "February", "March", "April", "May"],
  datasets: [{
    label: "Monthly Sales",
    data: [50, 120, 80, 150, 100],
    borderColor: 'rgba(75, 192, 192, 1)', // Line color
    borderWidth: 2, // Line width
    fill: true, // Fill the area under the line
    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Transparent background color
  }]
};

// Configuration for the line chart
const configLine = {
  type: 'line',
  data: dataLine,
  options: {
    scales: {
      x: {
        type: 'category', // Use category scale for the x-axis
        labels: dataLine.labels,
        barPercentage: 0.2, // Adjust the width of the bars (50% of the available space)
          categoryPercentage: 0.1, // Adjust the width of the category (40% of the available space)
          grid: {
            display: false, // Disable the grid for better appearance
          },
      },
      y: {
        beginAtZero: true,
      },
    },
  },
};

// Create a new line chart instance
var lineChart = new Chart(document.getElementById('lineChart'), configLine);
