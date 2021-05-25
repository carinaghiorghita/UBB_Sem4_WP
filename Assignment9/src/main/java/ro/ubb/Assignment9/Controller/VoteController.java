package ro.ubb.Assignment9.Controller;

import ro.ubb.Assignment9.DB.DBManager;
import ro.ubb.Assignment9.Domain.Photo;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;
import java.io.IOException;


public class VoteController extends HttpServlet {
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        int vote = Integer.parseInt(request.getParameter("pickVote"));
        int currentVotes = Integer.parseInt(request.getParameter("currentVotes"));
        int photoID = Integer.parseInt(request.getParameter("photoID"));

        int totalVotes = currentVotes + vote;

        DBManager dbm = new DBManager();
        dbm.updatePhoto(photoID,totalVotes);

        response.sendRedirect("vote.jsp");
    }
}
