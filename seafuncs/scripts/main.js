class AnimationHandler {
        runAnimation(el, animationName, { forwards = false } = {}) {
                if (!el) return;
                el.style.animation = `${animationName} 0.5s ease`;
                el.style.animationFillMode = forwards ? "forwards" : "none";
        }
}

const animation = new AnimationHandler();
const button = document.querySelector("#submit");

button?.addEventListener("click", () => {
        const textEl = document.querySelector(".text");
        if (!textEl) return;

        const text = textEl.innerHTML.trim();
        const encoded = text.replaceAll("\n", "\\");
        document.cookie = `text=${encoded}; expires=Thu, 18 Dec 2025 12:00:00 UTC; path=/`;
});

const mapObj = Object.fromEntries(
        Object.entries({
                0: "0",
                1: "1",
                2: "2",
                3: "3",
                4: "4",
                5: "5",
                6: "6",
                7: "7",
                8: "8",
                9: "9",
                GET: "GET",
                JOIN: "JOIN",
                UPDATE: "UPDATE",
                RATE: "RATE",
                EXISTS: "EXISTS",
                DELETE: "DELETE",
                LOGIN: "LOGIN",
                LOGOFF: "LOGOFF",
                RAND: "RAND",
        }).map(([k, v]) => [k, `<div class="hover-div"><cct>${v}</cct></div>`]),
);

const color2Words = [
        "levelid",
        "levelname",
        "accountid",
        "accid",
        "userid",
        "uid",
        "comments",
        "admin",
        "unrate",
        "level",
        "levels",
        "commentid",
        "comment",
        "stats",
        "coins",
        "username",
        "accountname",
        "variable",
        "data",
];
color2Words.forEach((w) => (mapObj[w] = `<span class="color2">${w}</span>`));

const re = new RegExp(Object.keys(mapObj).join("|"), "g");

const colorMention = (elText, elPre) => {
        if (!elText || !elPre) return;
        elPre.innerHTML = elText.innerHTML.replace(
                re,
                (match) => mapObj[match] || match,
        );
};

const scrollMirror = (elText, elPre) => {
        if (!elText || !elPre) return;
        elPre.scrollTo(elText.scrollLeft, elText.scrollTop);
};

const handleKey = (ev, elText, elPre) => {
        if (!elText || !elPre) return;

        if (ev.key === "Enter" && !ev.shiftKey) {
                ev.preventDefault();
                const message = elText.innerHTML.trim();
                if (!message) return;

                const encoded = message.replaceAll("\n", "\\");
                document.cookie = `text=${encoded}; expires=Thu, 18 Dec 2025 12:00:00 UTC; path=/`;
                window.location.reload();
        } else {
                scrollMirror(elText, elPre);
        }
};

document.querySelectorAll(".message").forEach((el) => {
        const elText = el.querySelector(".text");
        const elPre = el.querySelector(".pre");

        if (!elText || !elPre) return;

        elText.addEventListener("scroll", () => scrollMirror(elText, elPre));
        elText.addEventListener("keyup", () => scrollMirror(elText, elPre));
        elText.addEventListener("input", () => colorMention(elText, elPre));
        elText.addEventListener("keydown", (ev) =>
                handleKey(ev, elText, elPre),
        );

        colorMention(elText, elPre);
        scrollMirror(elText, elPre);
});

const isOnMobile = navigator.userAgentData?.mobile ?? false;
const isValidHexColor = (c) => /^#?([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/.test(c);

let paused = false;
const commandSet = new Set([
        "GET",
        "UPDATE",
        "RATE",
        "EXISTS",
        "DELETE",
        "LOGIN",
        "GET level",
        "GET account",
        "GET comment",
        "RAND",
        "LOGOFF",
        "JOIN",
]);

setInterval(() => {
        const textEl = document.querySelector(".text");
        const text = textEl?.innerHTML.trim() ?? "";
        const existingDiv = document.querySelector("#getDiv");
        const existingColor = document.querySelector("#colorDiv");

        if (existingDiv && !commandSet.has(text) && !isOnMobile) {
                existingDiv.remove();
                paused = false;
        }
        if (paused) return;

        if (commandSet.has(text) && !isOnMobile) {
                const getDiv = document.createElement("div");
                Object.assign(getDiv.style, {
                        width: "200px",
                        background: "#222",
                        border: "2px solid #444",
                        color: "#fff",
                        boxShadow: "0 4px 8px rgba(0,0,0,0.2)",
                        textAlign: "center",
                        position: "relative",
                        top: "-100px",
                        opacity: "0",
                });
                getDiv.id = "getDiv";

                const firstWord = text.split(" ")[0];
                const textVar = document.querySelector(".hover-div");
                if (textVar) {
                        textVar.addEventListener(
                                "mouseenter",
                                () => (getDiv.style.opacity = "1"),
                        );
                        textVar.addEventListener(
                                "mouseleave",
                                () => (getDiv.style.opacity = "0"),
                        );
                }

                fetch("../seafuncs/extra/documentation.json")
                        .then((res) => res.json())
                        .then((data) => {
                                const structure =
                                        data[firstWord]?.[0]?.structure || "";
                                getDiv.innerHTML = `
                    <img src="./assets/function.png" class="img" />
                    <p class="p2" style="position:relative;top:-10px">
                        <cc>${firstWord}()</cc> <br> ${structure}
                    </p>`;
                        })
                        .catch(() =>
                                console.warn("Could not load documentation."),
                        );

                document.body.appendChild(getDiv);
                paused = true;
        }

        const hex = new RegExp(/#?[0-9a-fA-F]{3,6}/).exec(text)?.[0];
        if (hex && isValidHexColor(hex)) {
                if (existingColor) {
                        existingColor.style.backgroundColor = hex;
                } else {
                        const colorDiv = document.createElement("div");
                        colorDiv.id = "colorDiv";
                        colorDiv.classList.add("colorDiv");
                        Object.assign(colorDiv.style, {
                                position: "fixed",
                                backgroundColor: hex,
                                top: "0px",
                                left: `${text.length * 10 + 10}px`,
                        });
                        document.body.appendChild(colorDiv);
                }
        } else if (existingColor) {
                existingColor.remove();
        }
}, 100);
