(function () {
  "use strict";

  function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");

    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
      nav.classList.toggle("nav-open");
      const isOpen = nav.classList.contains("nav-open");
      toggleBtn.setAttribute("aria-expanded", String(isOpen));
    });
  }

  function initDeleteConfirm() {
    document.addEventListener("click", function (event) {
      const btn = event.target.closest(".btn-delete");
      if (!btn) return;

      const row = btn.closest("tr");
      const firstCell = row ? row.querySelector("td") : null;
      const itemName = firstCell ? firstCell.textContent.trim() : "this item";
      const confirmed = window.confirm("Delete " + itemName + "?");

      if (confirmed && row) {
        row.remove();
        updateBookCounter();
      }
    });
  }

  function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector("table[data-search='title']");

    if (!input || !table) return;

    input.addEventListener("keyup", function () {
      const keyword = input.value.trim().toLowerCase();
      const rows = table.querySelectorAll("tbody tr");

      rows.forEach(function (row) {
        const titleCell = row.querySelector("td[data-title]");
        const title = titleCell ? titleCell.textContent.toLowerCase() : "";
        row.style.display = title.includes(keyword) ? "" : "none";
      });

      updateBookCounter();
    });
  }

  function clearError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
      next.remove();
    }
  }

  function showError(input, message) {
    clearError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = message;
    input.insertAdjacentElement("afterend", span);
  }

  function initFormValidation() {
    const form = document.getElementById("form-add");
    if (!form) return;

    form.addEventListener("submit", function (event) {
      event.preventDefault();

      let valid = true;
      form.querySelectorAll(".error").forEach(function (error) {
        error.remove();
      });

      const titleOrName = form.querySelector("[name='title'], [name='name']");
      if (titleOrName && titleOrName.value.trim() === "") {
        showError(titleOrName, "This field is required.");
        valid = false;
      }

      const author = form.querySelector("[name='author']");
      if (author && author.value.trim() === "") {
        showError(author, "Author is required.");
        valid = false;
      }

      const year = form.querySelector("[name='year']");
      if (year) {
        const yearValue = Number.parseInt(year.value, 10);
        if (Number.isNaN(yearValue) || yearValue < 1900 || yearValue > new Date().getFullYear()) {
          showError(year, "Enter a valid publication year.");
          valid = false;
        }
      }

      const stock = form.querySelector("[name='stock']");
      if (stock) {
        const stockValue = Number.parseInt(stock.value, 10);
        if (Number.isNaN(stockValue) || stockValue < 0) {
          showError(stock, "Stock must be 0 or greater.");
          valid = false;
        }
      }

      const isbn = form.querySelector("[name='isbn']");
      if (isbn && isbn.value.trim() !== "" && !/^[0-9-]+$/.test(isbn.value.trim())) {
        showError(isbn, "ISBN may contain digits and hyphens only.");
        valid = false;
      }

      if (valid) {
        const message = document.createElement("p");
        message.className = "success";
        message.textContent = "Form is valid. Ready to save.";
        form.appendChild(message);
      }
    });
  }

  function createActionCell() {
    const cell = document.createElement("td");

    const editButton = document.createElement("button");
    editButton.type = "button";
    editButton.textContent = "Edit";

    const deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.className = "btn-delete";
    deleteButton.textContent = "Delete";

    cell.appendChild(editButton);
    cell.appendChild(deleteButton);
    return cell;
  }

  function addCell(row, value, className) {
    const cell = document.createElement("td");
    cell.textContent = value;
    if (className) cell.className = className;
    row.appendChild(cell);
  }

  async function loadTableData(options) {
    const tbody = document.querySelector(options.tbodySelector);
    const loading = document.querySelector(options.loadingSelector);

    if (!tbody) return;

    if (loading) loading.style.display = "block";
    tbody.innerHTML = "";

    try {
      const response = await fetch(options.url);
      if (!response.ok) {
        throw new Error("Failed to fetch data (status " + response.status + ")");
      }

      
      await new Promise(function (resolve) {
        setTimeout(resolve, 3000);
      });

      const data = await response.json();

      data.forEach(function (item) {
        const row = document.createElement("tr");
        options.renderRow(row, item);
        tbody.appendChild(row);
      });

      if (options.afterRender) options.afterRender();
    } catch (error) {
      const row = document.createElement("tr");
      const cell = document.createElement("td");
      cell.colSpan = options.columnCount;
      cell.textContent = "Failed to load data: " + error.message;
      row.appendChild(cell);
      tbody.appendChild(row);
    } finally {
      if (loading) loading.style.display = "none";
    }
  }

  function loadBooks() {
    const tbody = document.querySelector("#book-table tbody");
    if (!tbody) return;

    loadTableData({
      url: "../data/books.json",
      tbodySelector: "#book-table tbody",
      loadingSelector: "#book-loading",
      columnCount: 5,
      renderRow: function (row, book) {
        addCell(row, book.title, "title-cell");
        row.lastElementChild.setAttribute("data-title", "true");
        addCell(row, book.author);
        addCell(row, book.year);
        addCell(row, book.stock);
        row.appendChild(createActionCell());
      },
      afterRender: updateBookCounter
    });
  }

  function loadMembers() {
    const tbody = document.querySelector("#member-table tbody");
    if (!tbody) return;

    loadTableData({
      url: "../data/members.json",
      tbodySelector: "#member-table tbody",
      loadingSelector: "#member-loading",
      columnCount: 6,
      renderRow: function (row, member) {
        addCell(row, member.member_no);
        addCell(row, member.name);
        addCell(row, member.gender);
        addCell(row, member.address);
        addCell(row, member.phone_no);
        row.appendChild(createActionCell());
      }
    });
  }

  function updateBookCounter() {
    const counter = document.getElementById("book-counter");
    const table = document.querySelector("#book-table");
    if (!counter || !table) return;

    const rows = Array.from(table.querySelectorAll("tbody tr"));
    const visibleRows = rows.filter(function (row) {
      return row.style.display !== "none";
    });

    const total = rows.length;
    counter.textContent = "Showing " + visibleRows.length + " of " + total + " books";
  }

  document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initDeleteConfirm();
    initTableFilter();
    initFormValidation();
    loadBooks();
    loadMembers();
  });
}());
