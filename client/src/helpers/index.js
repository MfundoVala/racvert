export function protectRoute(user, router) {
  if (user.token == undefined) {
    router.push({ name: "Login" });
    return;
  }
  if (user.active != 1) {
    router.push({ name: "RegisterBusiness" });
  } else {
    router.push({ name: "Home" });
  }
}
