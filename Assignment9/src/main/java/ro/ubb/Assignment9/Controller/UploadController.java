package ro.ubb.Assignment9.Controller;

import ro.ubb.Assignment9.DB.DBManager;
import ro.ubb.Assignment9.Domain.Photo;
import ro.ubb.Assignment9.Domain.User;

import javax.servlet.*;
import javax.servlet.http.*;
import java.io.IOException;

public class UploadController extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        DBManager dbm = new DBManager();

        User user = (User) request.getSession().getAttribute("user");
        String url = request.getParameter("imgUpload");
        Integer id = dbm.getNewID();

        System.out.println(url);

        if(id>0 && url != null && !url.equals("")) {
            Photo photo = new Photo(id, url, user.getId(), 0);
            dbm.addPhoto(photo);
        }

        response.sendRedirect("home.jsp");
    }
}
