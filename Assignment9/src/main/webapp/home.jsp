<%--
  Created by IntelliJ IDEA.
  User: Carina
  Date: 10/05/2021
  Time: 21:00
  To change this template use File | Settings | File Templates.
--%>
<%@ page import="ro.ubb.Assignment9.Domain.User" %>
<%@ page import="ro.ubb.Assignment9.DB.DBManager" %>
<%@ page import="ro.ubb.Assignment9.Domain.Photo" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Home</title>
    <!--<script src="js/jquery-2.0.3.js"></script>
    <script src="js/ajax-utils.js"></script>-->
    <style>
        html, body {
            height: 100%;
        }

        html {
            display: table;
            margin: auto;
        }

        body {
            display: table-cell;
            vertical-align: middle;
            background-color: lightcyan;
            font-family: "Arial", sans-serif;
        }

        .button {
            border-radius: 8px;
            background-color: lightskyblue;
        }

        .table {
            background-color: azure;
        }
    </style>
</head>
<body>
<%  User user = (User) session.getAttribute("user");
    if(user == null) {
        response.sendRedirect("index.jsp");
        return;
    }
    else {
%>
        <br><br><h3>Welcome, <%=user.getName()%>!</h3>
<%
    }
%>
<%--<form action="/VoteController" method="get">
    <button id="goToVoteBtn" type="button">Vote</button>
</form>--%>
<br>
<button class="button" onclick="document.location = 'vote.jsp'">See all photos</button>
<br><br>
<form action="UploadController" method="post">
    <label for="imgUpload">Upload a new photo:</label>
    <input type="file" id="imgUpload" name="imgUpload" accept="image"><br>
    <input class="button" type="submit" id="upload" value="Upload">
</form>
<br>
<form action="TopController" method="post">
    <label for="topNr">Please write the number of photos:</label>
    <input type="text" id="topNr" name="topNr" size="3"><br>
    <input class="button" id="seeTopBtn" type="submit" value="See top photos">
</form>

<%
    if (session.getAttribute( "topNr" ) != null){
        Integer topNr = (Integer) session.getAttribute("topNr");
        DBManager dbm = new DBManager();
        for(Photo photo: dbm.getTopPhotos(topNr)){
%>
<table class="table">
    <tr><td><img width="200" height="200" src="imgs/<%=photo.getUrl()%>"></td></tr>
    <tr><td>Author: <%=dbm.getUserName(photo.getuserID())%></td></tr>
    <tr><td>Number of votes: <%=photo.getVotes()%></td></tr>
</table>
<br><br>
<%
        }}
%>
<form action="HomeController" method="get">
    <input class="button" type="submit" id="logout" value="Log out">
</form>
</body>
</html>
