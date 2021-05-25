package ro.ubb.Assignment9.Controller;

import ro.ubb.Assignment9.DB.DBManager;
import ro.ubb.Assignment9.Domain.User;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;
import java.io.IOException;

//@WebServlet(name = "LoginController", value = "/LoginController")
public class LoginController extends HttpServlet {

    public LoginController(){super();}


    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        RequestDispatcher rd = null;

        DBManager dbmanager = new DBManager();
        User user = dbmanager.authenticate(username, password);
        if (user != null) {
            HttpSession session = request.getSession();
            session.setAttribute("user", user);
            session.setAttribute("fail",false);
            //rd = request.getRequestDispatcher("/home.jsp");
            response.sendRedirect("home.jsp");

        } else {
            HttpSession session = request.getSession();
            session.setAttribute("fail",true);
            //rd = request.getRequestDispatcher("/index.jsp");
            response.sendRedirect("index.jsp");
        }
        //rd.forward(request, response);

    }
}
