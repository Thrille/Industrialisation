class Modal {

    modalManager;
    wrapperNode;
    frame;
    element;
    title;
    frameHeader;
    frameTitle;

    constructor({title, element}) {
        this.title = title;
        this.element = element;
        this.modalManager = document.getElementById("modal-manager");
    }

    render() {

        this.close();

        this.wrapperNode = document.createElement("div");
        this.frame = document.createElement("div");
        this.closeButton = document.createElement("button");
        this.closeButtonText = document.createTextNode("⛌");
        this.frameContent = document.createElement("section");
        this.frameHeader = document.createElement("h1");
        this.frameTitle = document.createTextNode(this.title);
        this.frameHeadWrapper = document.createElement("div");

        this.wrapperNode.classList.add("modal");
        this.frame.classList.add("frame");
        this.closeButton.classList.add("close-button");
        this.frameHeadWrapper.classList.add("modal-header");
        this.frameContent.classList.add("modal-content");

        this.frameContent.appendChild(this.element);
        this.closeButton.appendChild(this.closeButtonText);
        this.frameHeader.appendChild(this.frameTitle);
        this.frameHeadWrapper.appendChild(this.frameHeader);
        this.frameHeadWrapper.appendChild(this.closeButton);
        this.frame.appendChild(this.frameHeadWrapper);
        this.frame.appendChild(this.frameContent);
        this.wrapperNode.appendChild(this.frame);
        this.modalManager.appendChild(this.wrapperNode);

        this.bindEvents();

        return this.wrapperNode;
    }

    open() {
        this.render();
    }

    close() {
        console.log("close");
        this.modalManager.innerHTML = "";
    }

    bindEvents() {
        if (this.closeButton) {
            this.closeButton.addEventListener("click", this.close.bind(this));
        }

        if (this.wrapperNode) {
            this.wrapperNode.addEventListener("click", this.close.bind(this));
        }
        
        if (this.frame) {
            this.frame.addEventListener("click", function(event) {
                event.stopPropagation();
            });
        }
    }
}

export default Modal;