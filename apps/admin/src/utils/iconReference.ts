// Common Feather Icons (react-icons/fi) reference
// This file helps avoid import errors by providing a reference of available icons

// Navigation & UI
export const NAVIGATION_ICONS = {
  home: 'FiHome',
  users: 'FiUsers', 
  settings: 'FiSettings',
  menu: 'FiMenu',
  search: 'FiSearch',
  filter: 'FiFilter',
  sort: 'FiArrowUpDown',
} as const;

// Charts & Analytics
export const CHART_ICONS = {
  barChart: 'FiBarChart2', // Note: FiBarChart3 doesn't exist
  trendingUp: 'FiTrendingUp',
  trendingDown: 'FiTrendingDown',
  activity: 'FiActivity',
  pieChart: 'FiPieChart',
} as const;

// Actions
export const ACTION_ICONS = {
  plus: 'FiPlus',
  edit: 'FiEdit',
  delete: 'FiTrash2',
  save: 'FiSave',
  cancel: 'FiX',
  check: 'FiCheck',
  refresh: 'FiRefreshCw',
} as const;

// User & Account
export const USER_ICONS = {
  user: 'FiUser',
  users: 'FiUsers',
  userPlus: 'FiUserPlus',
  userMinus: 'FiUserMinus',
  logOut: 'FiLogOut',
  logIn: 'FiLogIn',
} as const;

// Theme & Display
export const THEME_ICONS = {
  sun: 'FiSun',
  moon: 'FiMoon',
  eye: 'FiEye',
  eyeOff: 'FiEyeOff',
  bell: 'FiBell',
  notification: 'FiBell',
} as const;

// Files & Documents
export const FILE_ICONS = {
  file: 'FiFile',
  folder: 'FiFolder',
  download: 'FiDownload',
  upload: 'FiUpload',
  image: 'FiImage',
  fileText: 'FiFileText',
} as const;

// Common icon combinations for different use cases
export const ICON_SETS = {
  navigation: NAVIGATION_ICONS,
  charts: CHART_ICONS,
  actions: ACTION_ICONS,
  user: USER_ICONS,
  theme: THEME_ICONS,
  files: FILE_ICONS,
} as const;
