import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '@/views/Auth/Login'
import Dashboard from '@/views/Dashboard'
import Commuters from '@/views/Commuters'
import Admins from '@/views/Admins'
import Drivers from '@/views/Drivers'
import Beeps from '@/views/Beeps'
import Maps from '@/views/Maps'
import RouteManagement from '@/views/RouteManagement'
Vue.use(VueRouter)
const routes=[{path:'/login',name:'login',component:Login},{path:'/dashboard',name:'dashboard',component:Dashboard},{path:'/commuters',name:'commuters',component:Commuters},{path:'/admins',name:'admins',component:Admins},{path:'/drivers',name:'drivers',component:Drivers},{path:'/beeps',name:'beeps',component:Beeps},{path:'/maps',name:'routeBeepStops',component:Maps},{path:'/route-management',name:'routeManagement',component:RouteManagement},]
const router=new VueRouter({mode:'history',base:process.env.BASE_URL,routes})
router.beforeEach((to,from,next)=>{var auth=localStorage.getItem("BEEPTS-UserToken")
if(auth!==null&&to.path==='/login'){next(from)}else if(auth===null&&(to.path==='/route-management'||to.path==='/dashboard'||to.path==='/commuters'||to.path==='/admins'||to.path==='/drivers'||to.path==='/beeps'||to.path==='/maps')){next(from)}else{next()}
var adminType=localStorage.getItem("Admin-Position")
if((adminType==='staff')&&(to.path==='/admins')){next(from)}
if(auth!==null&&to.path==='/'){next('/dashboard')}else if(auth===null&&to.path==='/'){next('/login')}})
export default router